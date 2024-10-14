<?php

namespace PrimeKit\CheckKar\Console\Command\S3;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestStorageConnectionCommand extends Command
{
    protected $signature = 'test:storage-connection {disk? : The name of the storage disk to test}';

    protected $description = 'Test connection to a specified storage disk';

    public function handle()
    {
        $diskName = $this->argument('disk') ?? config('filesystems.default');

        $this->info("Testing connection for disk: {$diskName}");

        try {
            $disk = Storage::disk($diskName);
        } catch (\InvalidArgumentException $e) {
            $this->error("Disk '{$diskName}' is not defined in your filesystems configuration.");

            return;
        }

        // Test uploading a file
        $fileName = 'test_connection_'.time().'.txt';
        $fileContent = 'This is a test file.';

        try {
            if ($disk->put($fileName, $fileContent)) {
                $this->info('File uploaded successfully.');

                // Optionally, delete the file after testing
                $disk->delete($fileName);
            } else {
                $this->error('Failed to upload file.');

                return;
            }
        } catch (\Exception $e) {
            $this->error('Failed to upload file: '.$e->getMessage());

            return;
        }

        // Test listing files
        try {
            $files = $disk->files();
            if (count($files) > 0) {
                $this->info('Files in the disk:');
                foreach ($files as $file) {
                    $this->info($file);
                }
            } else {
                $this->info('No files found in the disk.');
            }
        } catch (\Exception $e) {
            $this->error('Failed to list files: '.$e->getMessage());
        }
    }
}
