<?php

namespace Database\Seeders;

use App\Models\AcademicCalendar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicCalendar::create(
            [
                'started_date' => now(),
                'ended_date' => now()->addYear()
            ]
        );
    }
}
