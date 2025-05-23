<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProposalExportByPeriode implements FromView
{
    public function __construct(private $proposals) {}

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $proposals = $this->proposals;

        return view('exports.proposal.index', compact('proposals'));
    }
}
