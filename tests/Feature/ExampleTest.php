<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\AcademicCalendar;
use Database\Seeders\AcademicCalendarSeeder;
use Illuminate\Support\Facades\Log;

class ExampleTest extends TestCase
{
    public function testData()
    {
        $this->seed(AcademicCalendarSeeder::class);

        $academicCalendarData = AcademicCalendar::select('started_date', 'ended_date')->get();

        $academicCalendarDatas = collect([]);

        foreach ($academicCalendarData as $key => $startedDate) {
            $academicCalendarDatas[] = $startedDate->periode_year;
        }

        Log::info($academicCalendarDatas);

        self::assertTrue(true);
    }
}
