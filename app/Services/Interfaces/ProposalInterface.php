<?php

namespace App\Services\Interfaces;

interface ProposalInterface
{
    public function getAllProposals();
    public function getProposalByAcademicCalendar($id);
    public function createProposal(array $data);
}
