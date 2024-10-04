<?php

namespace App\Jobs;

use App\Helpers\Exports\brandsExportXl;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class GeneralExportXl implements ShouldQueue
{
    use Queueable,Dispatchable;
    public function __construct(
        public Collection $data,
        public string $path,
        public array $columns,
        public bool $isLast = false,
        public string $fileName,
        public string $fileType
    ) {
        // Constructor
    }

    public function handle(): void
    {
        $tempPath = storage_path('app/public/export/xl/temp_' . $this->fileName . '_' . time() . '.' . $this->fileType);

        // Process data based on the file name
        switch ($this->fileName) {
            case 'brands':
                $export = new brandsExportXl($this->data, $this->columns);

                // Create a temporary file for each chunk
                Excel::store($export, $tempPath);

                // If it's the last chunk, merge all temporary files into the final file
                if ($this->isLast) {
                    $this->mergeTempFiles($this->path);

                    // Optionally, delete temporary files after merging
                    $this->cleanupTempFiles();
                }
                break;
        }
    }

    /**
     * Merge all temp files into one final file.
     */
    private function mergeTempFiles($finalPath)
    {
        // Open or create the final file
        $finalFile = fopen($finalPath, 'a');

        // Get all temporary files created by chunks
        $tempFiles = glob(storage_path('app/public/export/xl/temp_' . $this->fileName . '_*.xlsx'));

        // Append each temporary file's content to the final file
        foreach ($tempFiles as $tempFile) {
            $fileContent = file_get_contents($tempFile);
            fwrite($finalFile, $fileContent);
        }

        fclose($finalFile);
    }

    /**
     * Cleanup temporary files.
     */
    private function cleanupTempFiles()
    {
        $tempFiles = glob(storage_path('app/public/export/xl/temp_' . $this->fileName . '_*.xlsx'));
        foreach ($tempFiles as $tempFile) {
            unlink($tempFile); // Delete each temp file
        }
    }
}
