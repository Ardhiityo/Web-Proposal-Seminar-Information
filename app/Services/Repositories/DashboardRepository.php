<?php

namespace App\Services\Repositories;

use App\Models\AcademicCalendar;
use App\Models\Room;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Proposal;
use App\Services\Interfaces\DashboardInterface;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardInterface
{
    public function getDashboardData()
    {
        $totalStudents = Student::count();
        $totalLecturers = Lecture::count();
        $totalRooms = Room::count();
        $totalProposals = Proposal::count();
        $academicCalendars = AcademicCalendar::select('id', 'started_date', 'ended_date')
            ->latest()->take(5)->get();

        $academicPeriodes = [];
        $academicCalendarIds = [];

        foreach ($academicCalendars as $key => $academicCalendar) {
            $academicPeriodes[] = $academicCalendar->periode_year;
            $academicCalendarIds[] = $academicCalendar->id;
        }

        $totalProposalByPeriodes = [];

        $proposalPeriodes = Proposal::select('academic_calendar_id', DB::raw('COUNT(*) as total'))
            ->whereIn('academic_calendar_id', $academicCalendarIds)
            ->groupBy('academic_calendar_id')
            ->get();

        foreach ($proposalPeriodes as $key => $proposalPeriode) {
            $totalProposalByPeriodes[] = $proposalPeriode->total;
        }

        return compact(
            'totalStudents',
            'totalLecturers',
            'totalRooms',
            'totalProposals',
            'academicPeriodes',
            'totalProposalByPeriodes'
        );
    }
}
