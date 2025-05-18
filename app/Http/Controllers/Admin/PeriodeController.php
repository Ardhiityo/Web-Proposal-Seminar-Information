<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
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
        // Log::info($proposals->toArray());
        // dd($proposals->toArray());

        return view('pages.periode.show', compact('proposals', 'academicCalendar'));
    }
}
