<?php

namespace App\Jobs;

use App\Imports\LectureImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportLectureJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $file = Storage::disk('public')->path($this->path);
            Excel::import(new LectureImport, $file);
            Log::info('Import data dosen berhasil');
            Storage::disk('public')->delete($this->path);
            Log::info('File import berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal mengimport data: ' . $e->getMessage());
            throw $e;
        }
    }
}
