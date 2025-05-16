<?php

namespace App\Services\Repositories;

use App\Models\AcademicCalendar;
use App\Models\Room;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Proposal;
use App\Services\Interfaces\DashboardInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardInterface
{
    public function getDashboardData()
    {
        $totalStudents = Student::count();
        $totalLecturers = Lecture::count();
        $totalRooms = Room::count();
        $totalProposals = Proposal::count();
        $academicCalendars = AcademicCalendar::select('id', 'started_date', 'ended_date')->get();
        $proposalPeriodes = Proposal::select('academic_calendar_id', DB::raw('count(*) as total'))->groupBy('academic_calendar_id')->get();

        $academicCalendarData = [];
        $proposalPeriodeData = [];

        foreach ($academicCalendars as $key => $academicCalendar) {
            $academicCalendarData[] = $academicCalendar->periode_year;
        }

        foreach ($proposalPeriodes as $key => $proposalPeriode) {
            $proposalPeriodeData[] = $proposalPeriode->total;
        }

        return compact('totalStudents', 'totalLecturers', 'totalRooms', 'totalProposals', 'academicCalendarData', 'proposalPeriodeData');
    }
}
