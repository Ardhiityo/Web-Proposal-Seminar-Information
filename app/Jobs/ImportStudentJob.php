<?php

namespace App\Jobs;

use App\Imports\LectureImport;
use App\Imports\StudentImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportStudentJob implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    public $tries = 3;
    public $timeout = 120;

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
            Excel::import(new StudentImport, $file);
            Log::info('Import data mahasiswa berhasil');
            Storage::disk('public')->delete($this->path);
            Log::info('File import berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal mengimport data: ' . $e->getMessage());
            throw $e;
        }
    }
}
