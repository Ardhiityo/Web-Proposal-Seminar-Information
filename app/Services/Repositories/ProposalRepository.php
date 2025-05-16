<?php

namespace App\Services\Repositories;

use App\Models\Proposal;
use App\Services\Interfaces\ProposalInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProposalRepository implements ProposalInterface
{
    public function getAllProposals()
    {
        return Proposal::with(
            [
                'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'phone'),
                'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'phone'),
                'student' => fn(Builder $query) =>
                $query->with(['studyProgram' => fn(Builder $query) => $query->select('id', 'name')])
                    ->select('id', 'name', 'nim', 'study_program_id'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date')
            ]
        )->select(
            'id',
            'session_time',
            'session_date',
            'student_id',
            'lecture_1_id',
            'lecture_2_id',
            'academic_calendar_id',
            'room_id'
        )
            ->latest()
            ->get();
    }

    public function getProposalByAcademicCalendar($id)
    {
        return Proposal::with(
            [
                'lecture' => fn(Builder $query) => $query->select('id', 'name', 'phone'),
                'student' => fn(Builder $query) =>
                $query->with(['studyProgram' => fn(Builder $query) => $query->select('id', 'name')])
                    ->select('id', 'name', 'nim', 'study_program_id'),
                'room' => fn(Builder $query) => $query->select('id', 'name')
            ]
        )
            ->select('id', 'lecture_1_id', 'lecture_2_id', 'session_date', 'session_time', 'student_id', 'room_id')
            ->where('academic_calendar_id', $id)
            ->latest()
            ->get();
    }

    public function getProposalById($id)
    {
        try {
            return Proposal::with(
                [
                    'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'phone'),
                    'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'phone'),
                    'student' => fn(Builder $query) =>
                    $query->with(['studyProgram' => fn(Builder $query) => $query->select('id', 'name')])
                        ->select('id', 'name', 'nim', 'study_program_id'),
                    'room' => fn(Builder $query) => $query->select('id', 'name'),
                    'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date')
                ]
            )
                ->select(
                    'id',
                    'session_time',
                    'session_date',
                    'student_id',
                    'lecture_1_id',
                    'lecture_2_id',
                    'academic_calendar_id',
                    'room_id'
                )
                ->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function createProposal(array $data)
    {
        return Proposal::create($data);
    }

    public function updateProposal($id, array $data)
    {
        return $this->getProposalById($id)->update($data);
    }

    public function deleteProposal($id)
    {
        return Proposal::destroy($id);
    }
}
