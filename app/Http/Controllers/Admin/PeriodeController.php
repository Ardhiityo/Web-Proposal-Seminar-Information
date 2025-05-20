<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Repositories\ProposalRepository;
use App\Services\Interfaces\AcademicCalendarInterface;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function __construct(
        private ProposalRepository $proposalRepository,
        private AcademicCalendarInterface $academicCalendarRepository
    ) {}

    public function show(Request $request, $id)
    {
        if ($keyword = $request->query('session_date')) {
            $proposals = $this->proposalRepository->getProposalByKeyword($id, $keyword);
        } else {
            $proposals = $this->proposalRepository->getProposalByAcademicCalendar($id);
        }
        $sessionDates = $this->proposalRepository->getAllSessionDatesProposalByAcademicCalendar($id);
        $academicCalendar = $this->academicCalendarRepository->getAcademicCalendarById($id);

        return view('pages.periode.show', compact('proposals', 'academicCalendar', 'sessionDates'));
    }
}
