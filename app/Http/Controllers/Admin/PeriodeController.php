<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Services\Interfaces\AcademicCalendarInterface;
use App\Services\Repositories\ProposalRepository;

class PeriodeController extends Controller
{
    public function __construct(
        private ProposalRepository $proposalRepository,
        private AcademicCalendarInterface $academicCalendarRepository
    ) {}

    public function show($id)
    {
        $proposals = $this->proposalRepository->getProposalByAcademicCalendar($id);
        $academicCalendar = $this->academicCalendarRepository->getAcademicCalendarById($id);

        return view('pages.periode.show', compact('proposals', 'academicCalendar'));
    }
}
