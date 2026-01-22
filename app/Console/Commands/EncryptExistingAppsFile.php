<?php

namespace App\Console\Commands;

use App\Services\EncryptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EncryptExistingAppsFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appsfile:encrypt
                            {--decrypt : Decrypt apps_file instead of encrypting}
                            {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt or decrypt existing apps_file url and file_name fields';

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
        $this->info("$action apps_file table (url, file_name)...");

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }

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
                    $newUrl = $this->encryptionService->decrypt($currentUrl);
                    $newFileName = $this->encryptionService->decrypt($currentFileName);

                    if ($newUrl === $currentUrl && $newFileName === $currentFileName) {
                        $skipped++;
                        $progressBar->advance();
                        continue;
                    }
                } else {
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

        if ($dryRun) {
            $this->warn("\nDry run complete. Run without --dry-run to apply changes.");
        } else {
            $this->info("\n" . ($decrypt ? 'Decryption' : 'Encryption') . " complete!");
        }

        return $errors > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
