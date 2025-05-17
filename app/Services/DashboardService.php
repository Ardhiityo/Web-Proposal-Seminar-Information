<?php

namespace App\Services;

use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\RoomInterface;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Interfaces\ProposalInterface;
use App\Services\Interfaces\AcademicCalendarInterface;

class DashboardService
{
    public function __construct(
        private StudentInterface $studentRepository,
        private LectureInterface $lectureRepository,
        private RoomInterface $roomRepository,
        private ProposalInterface $proposalRepository,
        private AcademicCalendarInterface $academicCalendarRepository
    ) {}

    public function getDashboardData()
    {
        $totalStudents = $this->studentRepository->getTotalStudents();
        $totalLecturers = $this->lectureRepository->getTotalLectures();
        $totalRooms = $this->roomRepository->getTotalRooms();
        $totalProposals = $this->proposalRepository->getTotalProposals();
        $academicCalendars = $this->academicCalendarRepository->getLatestAcademicCalendars();

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

        $latestProposals = $this->proposalRepository->getLatestProposals();

        return compact(
            'totalStudents',
            'totalLecturers',
            'totalRooms',
            'totalProposals',
            'academicPeriodes',
            'totalProposalByPeriodes',
            'latestProposals'
        );
    }
}
