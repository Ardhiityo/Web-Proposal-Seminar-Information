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

    public function createAcademicCalendar($data)
    {
        return AcademicCalendar::create($data);
    }

    public function getAcademicCalendarById($id)
    {
        try {
            return AcademicCalendar::select('id', 'started_date', 'ended_date')->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function updateAcademicCalendar($data, $id)
    {
        //
    }

    public function deleteAcademicCalendar($id)
    {
        return $this->getAcademicCalendarById($id)->delete();
    }
}
