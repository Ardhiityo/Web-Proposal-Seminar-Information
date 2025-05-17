<?php

namespace App\Services\Repositories;

use App\Models\AcademicCalendar;
use App\Services\Interfaces\AcademicCalendarInterface;

class AcademicCalendarRepository implements AcademicCalendarInterface
{
    public function getAllAcademicCalendars()
    {
        return AcademicCalendar::select('id', 'started_date', 'ended_date')->latest()->get();
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

    public function updateAcademicCalendar($id, $data)
    {
        $academicCalendar = $this->getAcademicCalendarById($id);

        return $academicCalendar->update($data);
    }

    public function deleteAcademicCalendar($id)
    {
        return $this->getAcademicCalendarById($id)->delete();
    }

    public function getLatestAcademicCalendars()
    {
        return AcademicCalendar::select('id', 'started_date', 'ended_date')
            ->latest()->take(3)->get();
    }
}
