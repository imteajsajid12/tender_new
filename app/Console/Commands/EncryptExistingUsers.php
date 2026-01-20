<?php

namespace App\Console\Commands;

use App\Services\EncryptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EncryptExistingUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:encrypt
                            {--decrypt : Decrypt users instead of encrypting}
                            {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt or decrypt existing user name and email fields';

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
        $this->info("$action user data...");

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }

        $users = DB::table('users')->get();

        $progressBar = $this->output->createProgressBar(count($users));
        $progressBar->start();

        $processed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($users as $user) {
            try {
                $currentName = $user->name;
                $currentEmail = $user->email;

                if ($decrypt) {
                    // Decrypt mode
                    $newName = $this->encryptionService->decrypt($currentName);
                    $newEmail = $this->encryptionService->decrypt($currentEmail);

                    // If decryption returns the same value, it wasn't encrypted
                    if ($newName === $currentName && $newEmail === $currentEmail) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }
                } else {
                    // Encrypt mode - skip if already encrypted
                    if ($this->encryptionService->isEncrypted($currentName) &&
                        $this->encryptionService->isEncrypted($currentEmail)) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }

                    $newName = $this->encryptionService->encryptIfNotEncrypted($currentName);
                    $newEmail = $this->encryptionService->encryptIfNotEncrypted($currentEmail);
                }

                if (!$dryRun) {
                    $updateData = [
                        'name' => $newName,
                        'email' => $newEmail,
                    ];

                    if (!$decrypt) {
                        $updateData['encryption_key_slot'] = $this->encryptionService->getCurrentKeySlot();
                    } else {
                        $updateData['encryption_key_slot'] = null;
                    }

                    DB::table('users')
                        ->where('id', $user->id)
                        ->update($updateData);
                }

                $processed++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error("Error processing user ID {$user->id}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("Summary:");
        $this->line("  Processed: $processed");
        $this->line("  Skipped (already " . ($decrypt ? 'decrypted' : 'encrypted') . "): $skipped");

        if ($errors > 0) {
            $this->error("  Errors: $errors");
        }

        if ($dryRun) {
            $this->warn("\nDry run complete. Run without --dry-run to apply changes.");
        } else {
            $this->info("\n" . ($decrypt ? 'Decryption' : 'Encryption') . " complete!");
        }

        return $errors > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
