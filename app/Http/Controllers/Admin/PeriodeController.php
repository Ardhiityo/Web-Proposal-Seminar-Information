<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Repositories\ProposalRepository;
use App\Services\Interfaces\AcademicCalendarInterface;

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
