<?php

namespace App\Services\Repositories;

use App\Models\AcademicCalendar;
use App\Services\Interfaces\AcademicCalendarInterface;

class AcademicCalendarRepository implements AcademicCalendarInterface
{
    public function getAllAcademicCalendars()
    {
        return AcademicCalendar::select('id', 'started_date', 'ended_date')->get();
    }
}
