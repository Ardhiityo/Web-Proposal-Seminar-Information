<?php

namespace App\Services\Repositories;

use Carbon\Carbon;
use App\Models\Proposal;
use App\Services\Interfaces\ProposalInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProposalRepository implements ProposalInterface
{
    public function getAllProposals()
    {
        return Proposal::with(
            [
                'student' => fn(Builder $query) => $query->select('id', 'name', 'nim'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date')
            ]
        )->select(
            'id',
            'session_time',
            'session_date',
            'student_id',
            'academic_calendar_id',
            'room_id'
        )
            ->latest()
            ->get();
    }

    public function getAllProposalsByKeyword($started_date, $ended_date)
    {
        $started_date = trim($started_date);
        $ended_date = trim($ended_date);

        return Proposal::with(
            [
                'student' => fn(Builder $query) => $query->with([
                    'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                    'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
                ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
                'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
                'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
                'moderator' => fn(Builder $query) => $query->select('id', 'name'),
            ]
        )->select(
            'id',
            'session_time',
            'session_date',
            'student_id',
            'academic_calendar_id',
            'room_id',
            'examiner_1_id',
            'examiner_2_id',
            'moderator_id'
        )
            ->whereHas('academicCalendar', function (Builder $query) use ($started_date, $ended_date) {
                $query
                    ->whereDate('started_date', '>=', $started_date)
                    ->whereDate('ended_date', '<=', $ended_date);
            })->paginate(10);
    }

    public function getAllSessionDatesProposalByAcademicCalendar($id)
    {
        return Proposal::select('session_date')
            ->where('academic_calendar_id', $id)->get();
    }

    public function getAllProposalsByPaginate()
    {
        return Proposal::with(
            [
                'student' => fn(Builder $query) => $query->with([
                    'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                    'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
                ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
                'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
                'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
                'moderator' => fn(Builder $query) => $query->select('id', 'name')
            ]
        )->select(
            'id',
            'session_time',
            'session_date',
            'student_id',
            'academic_calendar_id',
            'room_id',
            'examiner_1_id',
            'examiner_2_id',
            'moderator_id'
        )
            ->latest()
            ->paginate(perPage: 10);
    }

    public function getProposalByKeyword($academicCalendarId, $keyword)
    {
        $proposals = Proposal::with([
            'student' => fn(Builder $query) => $query->with([
                'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
            ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
            'room' => fn(Builder $query) => $query->select('id', 'name'),
            'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
            'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
            'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
            'moderator' => fn(Builder $query) => $query->select('id', 'name'),
        ])
            ->select(
                'id',
                'session_date',
                'session_time',
                'student_id',
                'room_id',
                'academic_calendar_id',
                'examiner_1_id',
                'examiner_2_id',
                'moderator_id'
            )
            ->where('academic_calendar_id', $academicCalendarId)
            ->whereDate('session_date', $keyword)
            ->orderBy('session_date', 'desc')
            ->orderBy('session_time', 'asc')
            ->get()
            ->groupBy('session_date');

        // Mengubah collection menjadi paginator
        $page = request()->get('page', 1);
        $perPage = 10;

        $items = $proposals->forPage($page, $perPage);

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $proposals->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
    }

    public function getProposalByAcademicCalendar($id)
    {
        $proposals = Proposal::with([
            'student' => fn(Builder $query) => $query->with([
                'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
            ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
            'room' => fn(Builder $query) => $query->select('id', 'name'),
            'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
            'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
            'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
            'moderator' => fn(Builder $query) => $query->select('id', 'name'),
        ])
            ->select(
                'id',
                'session_date',
                'session_time',
                'student_id',
                'room_id',
                'academic_calendar_id',
                'examiner_1_id',
                'examiner_2_id',
                'moderator_id'
            )
            ->where('academic_calendar_id', $id)
            ->orderBy('session_date', 'desc')
            ->orderBy('session_time', 'asc')
            ->get()
            ->groupBy('session_date');

        // Mengubah collection menjadi paginator
        $page = request()->get('page', 1);
        $perPage = 10;

        $items = $proposals->forPage($page, $perPage);

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $proposals->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
    }

    public function getAllMonthsProposalByAcademicCalendar($academicCalendarId)
    {
        $proposals = Proposal::select('session_date')
            ->where('academic_calendar_id', $academicCalendarId)
            ->distinct('')
            ->orderBy('session_date')
            ->get();

        $months = [];

        foreach ($proposals as $key => $proposal) {
            if (count($months) == 0) {
                $months[] = $proposal->session_month;
            }
            if (!in_array($proposal->session_month, $months)) {
                $months[] = $proposal->session_month;
            }
        }

        return $months;
    }

    public function getProposalByMonth($academicCalendarId, $start_month, $end_month)
    {
        $startMonthNumber = Carbon::parse($start_month)->format('m');
        $endMonthNumber = Carbon::parse($end_month)->format('m');

        return Proposal::with([
            'student' => fn(Builder $query) => $query->with([
                'lecture1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
                'lecture2' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
            'room' => fn(Builder $query) => $query->select('id', 'name'),
            'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
            'examiner1' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            'examiner2' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
            'moderator' => fn(Builder $query) => $query->select('id', 'name', 'nidn'),
        ])
            ->select(
                'id',
                'session_date',
                'session_time',
                'student_id',
                'room_id',
                'academic_calendar_id',
                'examiner_1_id',
                'examiner_2_id',
                'moderator_id'
            )
            ->orderBy('session_date')
            ->where('academic_calendar_id', $academicCalendarId)
            ->whereMonth('session_date', '>=', $startMonthNumber)
            ->whereMonth('session_date', '<=', $endMonthNumber)
            ->get();
    }

    public function getProposalById($id)
    {
        try {
            return Proposal::with(
                [
                    'student' => fn(Builder $query) => $query->with([
                        'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                        'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
                    ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
                    'room' => fn(Builder $query) => $query->select('id', 'name'),
                    'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
                    'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
                    'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
                    'moderator' => fn(Builder $query) => $query->select('id', 'name'),
                ]
            )
                ->select(
                    'id',
                    'session_time',
                    'session_date',
                    'student_id',
                    'academic_calendar_id',
                    'room_id',
                    'examiner_1_id',
                    'examiner_2_id',
                    'moderator_id'
                )
                ->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function getProposalByStudent($id)
    {
        return Proposal::with(
            [
                'student' => fn(Builder $query) => $query->with([
                    'lecture1' => fn(Builder $query) => $query->select('id', 'name'),
                    'lecture2' => fn(Builder $query) => $query->select('id', 'name'),
                ])->select('id', 'name', 'nim', 'lecture_1_id', 'lecture_2_id'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date'),
                'examiner1' => fn(Builder $query) => $query->select('id', 'name'),
                'examiner2' => fn(Builder $query) => $query->select('id', 'name'),
                'moderator' => fn(Builder $query) => $query->select('id', 'name'),
            ]
        )
            ->select(
                'id',
                'session_date',
                'session_time',
                'student_id',
                'room_id',
                'academic_calendar_id',
                'examiner_1_id',
                'examiner_2_id',
                'moderator_id'
            )
            ->where('student_id', $id)
            ->latest()
            ->paginate(perPage: 10);
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

    public function getLatestProposals()
    {
        return Proposal::with(
            [
                'student' => fn(Builder $query) => $query->select('id', 'name', 'nim'),
                'room' => fn(Builder $query) => $query->select('id', 'name'),
                'academicCalendar' => fn(Builder $query) => $query->select('id', 'started_date', 'ended_date')
            ]
        )
            ->select(
                'id',
                'session_date',
                'session_time',
                'student_id',
                'room_id',
                'academic_calendar_id',
                'created_at'
            )
            ->latest()
            ->take(3)
            ->get();
    }

    public function getTotalProposals()
    {
        return Proposal::count();
    }
}
