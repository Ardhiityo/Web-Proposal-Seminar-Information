<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProposalInterface;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function __construct(private ProposalInterface $proposalRepository) {}

    public function index()
    {
        $proposals = $this->proposalRepository->getAllProposals();

        return view('pages.proposal.index', compact('proposals'));
    }
}
