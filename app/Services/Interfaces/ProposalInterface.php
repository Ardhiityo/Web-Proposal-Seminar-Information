<?php

namespace App\Services\Interfaces;

interface ProposalInterface
{
    public function getAllProposals();
    public function getProposalByAcademicCalendar($id);
    public function createProposal(array $data);
    public function updateProposal($id, array $data);
    public function deleteProposal($id);
    public function getProposalById($id);
    public function getProposalByStudent($id);
}
