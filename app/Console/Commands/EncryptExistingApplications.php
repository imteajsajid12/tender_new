<?php

namespace App\Console\Commands;

use App\Services\EncryptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EncryptExistingApplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applications:encrypt
                            {--decrypt : Decrypt applications instead of encrypting}
                            {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt or decrypt existing applications.email fields';

    protected EncryptionService $encryptionService;

    public function __construct(EncryptionService $encryptionService)
    {
        parent::__construct();
        $this->encryptionService = $encryptionService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $decrypt = $this->option('decrypt');
        $dryRun = $this->option('dry-run');

        $action = $decrypt ? 'Decrypting' : 'Encrypting';
        $this->info("$action applications.email field...");

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }

        // We'll process two places where a candidate's/stored email commonly appears:
        // 1) applications.email    (main application record)
        // 2) app_decisions.email   (decision/candidate records used in many flows)
        // This ensures both places are covered by a single safe, idempotent command.

        $tables = [
            ['name' => 'applications', 'id_col' => 'id'],
            ['name' => 'app_decisions', 'id_col' => 'id'],
        ];

        $totalProcessed = 0;
        $totalSkipped = 0;
        $totalErrors = 0;

        foreach ($tables as $tableInfo) {
            $table = $tableInfo['name'];
            $idCol = $tableInfo['id_col'];

            $this->info("\nScanning table: $table (column: email)");

            $records = DB::table($table)->get();

            $progressBar = $this->output->createProgressBar(count($records));
            $progressBar->start();

            $processed = 0;
            $skipped = 0;
            $errors = 0;

            foreach ($records as $record) {
                try {
                    $currentEmail = $record->email;

                    $alreadyEncrypted = $this->encryptionService->isEncrypted($currentEmail);

                    if ($decrypt) {
                        $newEmail = $this->encryptionService->decrypt($currentEmail);

                        if ($newEmail === $currentEmail) {
                            $skipped++;
                            $progressBar->advance();
                            continue;
                        }
                    } else {
                        if ($alreadyEncrypted) {
                            // Email is already encrypted, but we still need to update encryption_key_slot if it's null
                            $needsKeySlotUpdate = false;
                            try {
                                if (\Schema::hasColumn($table, 'encryption_key_slot')) {
                                    $currentKeySlot = $record->encryption_key_slot ?? null;
                                    if ($currentKeySlot === null) {
                                        $needsKeySlotUpdate = true;
                                    }
                                }
                            } catch (\Exception $ex) {
                                // Ignore schema check errors
                            }

                            if ($needsKeySlotUpdate && !$dryRun) {
                                DB::table($table)
                                    ->where($idCol, $record->{$idCol})
                                    ->update(['encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()]);
                                $processed++;
                            } else {
                                $skipped++;
                            }
                            $progressBar->advance();
                            continue;
                        }

                        $newEmail = $this->encryptionService->encryptIfNotEncrypted($currentEmail);
                    }

                    if (!$dryRun) {
                        // Only include encryption_key_slot if the column exists in the table
                        $updateData = ['email' => $newEmail];
                        try {
                            if (\Schema::hasColumn($table, 'encryption_key_slot')) {
                                if (!$decrypt) {
                                    $updateData['encryption_key_slot'] = $this->encryptionService->getCurrentKeySlot();
                                } else {
                                    $updateData['encryption_key_slot'] = null;
                                }
                            }
                        } catch (\Exception $ex) {
                            // If schema introspection fails, proceed without setting the column
                        }

                        DB::table($table)
                            ->where($idCol, $record->{$idCol})
                            ->update($updateData);
                    }

                    $processed++;
                } catch (\Exception $e) {
                    $errors++;
                    $this->newLine();
                    $this->error("Error processing $table ID {$record->{$idCol}}: " . $e->getMessage());
                }

                $progressBar->advance();
            }

            $progressBar->finish();
            $this->newLine(2);

            $this->info(ucfirst($table) . " Summary:");
            $this->line("  Processed: $processed");
            $this->line("  Skipped (already " . ($decrypt ? 'decrypted' : 'encrypted') . "): $skipped");

            if ($errors > 0) {
                $this->error("  Errors: $errors");
            }

            $totalProcessed += $processed;
            $totalSkipped += $skipped;
            $totalErrors += $errors;
        }

        // Grand summary
        $this->newLine();
        $this->info("Overall Summary:");
        $this->line("  Total Processed: $totalProcessed");
        $this->line("  Total Skipped: $totalSkipped");
        if ($totalErrors > 0) {
            $this->error("  Total Errors: $totalErrors");
        }

        if ($dryRun) {
            $this->warn("\nDry run complete. Run without --dry-run to apply changes.");
        } else {
            $this->info("\n" . ($decrypt ? 'Decryption' : 'Encryption') . " complete!");
        }

        return $totalErrors > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
