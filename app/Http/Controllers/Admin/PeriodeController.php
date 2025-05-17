<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Repositories\ProposalRepository;

class PeriodeController extends Controller
{
    public function __construct(private ProposalRepository $proposalRepository) {}

    public function show($id)
    {
        $proposals = $this->proposalRepository->getProposalByAcademicCalendar($id);

        return view('pages.periode.show', compact('proposals'));
    }
}
