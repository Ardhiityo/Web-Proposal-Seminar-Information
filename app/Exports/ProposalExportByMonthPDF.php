<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProposalExportByMonthPDF implements FromView
{
    public function __construct(private $proposals) {}

    public function view(): View
    {
        $proposals = $this->proposals;
        return view('exports.proposal.index', compact('proposals'));
    }
}
