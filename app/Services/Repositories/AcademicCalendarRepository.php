<?php

namespace App\Services\Repositories;

use App\Models\AcademicCalendar;
use App\Services\Interfaces\AcademicCalendarInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AcademicCalendarRepository implements AcademicCalendarInterface
{
    public function getAllAcademicCalendars()
    {
        return AcademicCalendar::select('id', 'started_date', 'ended_date')->latest()->get();
    }

    public function getAllStartedDateAcademicCalendars()
    {
        return AcademicCalendar::select('started_date')->get();
    }

    public function getAllEndedDateAcademicCalendars()
    {
        return AcademicCalendar::select('ended_date')->get();
    }

    public function getAllAcademicCalendarsByPaginate()
    {
        return AcademicCalendar::select('id', 'started_date', 'ended_date')->latest()->paginate(perPage: 10);
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
        return AcademicCalendar::with(
            [
                'proposals' => fn(Builder $query) => $query->select('id', 'academic_calendar_id')
            ]
        )->select('id', 'started_date', 'ended_date')
            ->latest()->take(3)->get()->sortBy('id');
    }
}
