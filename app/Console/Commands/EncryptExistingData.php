<?php

namespace App\Console\Commands;

use App\Services\EncryptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EncryptExistingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:encrypt
                            {--table=all : Table to encrypt (applications, apps_file, or all)}
                            {--decrypt : Decrypt data instead of encrypting}
                            {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt or decrypt existing data in applications (email) and apps_file (url, file_name) tables';

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
        $table = $this->option('table');
        $decrypt = $this->option('decrypt');
        $dryRun = $this->option('dry-run');

        $action = $decrypt ? 'Decrypting' : 'Encrypting';

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }

        $totalErrors = 0;

        if ($table === 'all' || $table === 'applications') {
            $this->info("\n$action applications table (email field)...");
            $totalErrors += $this->processApplications($decrypt, $dryRun);
        }

        if ($table === 'all' || $table === 'apps_file') {
            $this->info("\n$action apps_file table (url, file_name fields)...");
            $totalErrors += $this->processAppsFile($decrypt, $dryRun);
        }

        if ($dryRun) {
            $this->warn("\nDry run complete. Run without --dry-run to apply changes.");
        } else {
            $this->info("\n" . ($decrypt ? 'Decryption' : 'Encryption') . " complete!");
        }

        return $totalErrors > 0 ? Command::FAILURE : Command::SUCCESS;
    }

    /**
     * Process applications table.
     */
    protected function processApplications(bool $decrypt, bool $dryRun): int
    {
        $records = DB::table('applications')->get();

        $progressBar = $this->output->createProgressBar(count($records));
        $progressBar->start();

        $processed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($records as $record) {
            try {
                $currentEmail = $record->email;

                if ($decrypt) {
                    // Decrypt mode
                    $newEmail = $this->encryptionService->decrypt($currentEmail);

                    // If decryption returns the same value, it wasn't encrypted
                    if ($newEmail === $currentEmail) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }
                } else {
                    // Encrypt mode - skip if already encrypted
                    if ($this->encryptionService->isEncrypted($currentEmail)) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }

                    $newEmail = $this->encryptionService->encryptIfNotEncrypted($currentEmail);
                }

                if (!$dryRun) {
                    $updateData = ['email' => $newEmail];

                    if (!$decrypt) {
                        $updateData['encryption_key_slot'] = $this->encryptionService->getCurrentKeySlot();
                    } else {
                        $updateData['encryption_key_slot'] = null;
                    }

                    DB::table('applications')
                        ->where('id', $record->id)
                        ->update($updateData);
                }

                $processed++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error("Error processing application ID {$record->id}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("Applications Summary:");
        $this->line("  Processed: $processed");
        $this->line("  Skipped (already " . ($decrypt ? 'decrypted' : 'encrypted') . "): $skipped");

        if ($errors > 0) {
            $this->error("  Errors: $errors");
        }

        return $errors;
    }

    /**
     * Process apps_file table.
     */
    protected function processAppsFile(bool $decrypt, bool $dryRun): int
    {
        $records = DB::table('apps_file')->get();

        $progressBar = $this->output->createProgressBar(count($records));
        $progressBar->start();

        $processed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($records as $record) {
            try {
                $currentUrl = $record->url;
                $currentFileName = $record->file_name;

                if ($decrypt) {
                    // Decrypt mode
                    $newUrl = $this->encryptionService->decrypt($currentUrl);
                    $newFileName = $this->encryptionService->decrypt($currentFileName);

                    // If decryption returns the same values, they weren't encrypted
                    if ($newUrl === $currentUrl && $newFileName === $currentFileName) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }
                } else {
                    // Encrypt mode - skip if already encrypted
                    if ($this->encryptionService->isEncrypted($currentUrl) &&
                        $this->encryptionService->isEncrypted($currentFileName)) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }

                    $newUrl = $this->encryptionService->encryptIfNotEncrypted($currentUrl);
                    $newFileName = $this->encryptionService->encryptIfNotEncrypted($currentFileName);
                }

                if (!$dryRun) {
                    $updateData = [
                        'url' => $newUrl,
                        'file_name' => $newFileName,
                    ];

                    if (!$decrypt) {
                        $updateData['encryption_key_slot'] = $this->encryptionService->getCurrentKeySlot();
                    } else {
                        $updateData['encryption_key_slot'] = null;
                    }

                    DB::table('apps_file')
                        ->where('id', $record->id)
                        ->update($updateData);
                }

                $processed++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error("Error processing apps_file ID {$record->id}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("Apps_file Summary:");
        $this->line("  Processed: $processed");
        $this->line("  Skipped (already " . ($decrypt ? 'decrypted' : 'encrypted') . "): $skipped");

        if ($errors > 0) {
            $this->error("  Errors: $errors");
        }

        return $errors;
    }
}
