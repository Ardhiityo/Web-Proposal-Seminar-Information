<?php

namespace App\Services\Interfaces;

interface ProposalInterface
{
    public function getAllProposals();
    public function getProposalByAcademicCalendar($id);
}
