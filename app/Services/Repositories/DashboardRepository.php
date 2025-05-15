<?php

namespace App\Services\Repositories;

use App\Models\Room;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Proposal;
use App\Services\Interfaces\DashboardInterface;

class DashboardRepository implements DashboardInterface
{
    public function getDashboardData()
    {
        $totalStudents = Student::count();
        $totalLecturers = Lecture::count();
        $totalRooms = Room::count();
        $totalProposals = Proposal::count();

        return compact('totalStudents', 'totalLecturers', 'totalRooms', 'totalProposals');
    }
}
