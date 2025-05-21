<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\RoomInterface;
use App\Services\Interfaces\HistoryInterface;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Interfaces\ProposalInterface;
use App\Http\Requests\Proposal\StoreProposalRequest;
use App\Http\Requests\Proposal\UpdateProposalRequest;
use App\Services\Interfaces\AcademicCalendarInterface;

class ProposalController extends Controller
{
    public function __construct(
        private ProposalInterface $proposalRepository,
        private StudentInterface $studentRepository,
        private LectureInterface $lectureRepository,
        private AcademicCalendarInterface $academicCalendarRepository,
        private RoomInterface $roomRepository,
        private HistoryInterface $historyRepository,
    ) {}

    public function index(Request $request)
    {
        if ($nim = $request->query('nim')) {
            try {
                $this->historyRepository->createHistory($nim);
                $student = $this->studentRepository->getStudentByNim($nim);
                $proposals = $this->proposalRepository->getProposalByStudent($student->id);
            } catch (\Throwable $th) {
                return redirect()->route('proposals.index')
                    ->with('nim_not_found', 'Belum ada jadwal tersedia...');
            }
        } else if ($request->query('started_date') && $request->query('ended_date')) {
            $started_date = $request->query('started_date');
            $ended_date = $request->query('ended_date');
            $proposals = $this->proposalRepository->getAllProposalsByKeyword($started_date, $ended_date);
        } else {
            $proposals = $this->proposalRepository->getAllProposalsByPaginate();
        }

        $startedAcademicCalendars = $this->academicCalendarRepository->getAllStartedDateAcademicCalendars();
        $endedAcademicCalendars = $this->academicCalendarRepository->getAllEndedDateAcademicCalendars();

        return view('pages.proposal.index', compact('proposals', 'startedAcademicCalendars', 'endedAcademicCalendars'));
    }

    public function create()
    {
        if (!Auth::user()->can('create-proposal')) {
            abort(403, 'Unauthorized action.');
        }

        $students = $this->studentRepository->getAllStudents();
        $lectures = $this->lectureRepository->getAllLectures();
        $academicCalendars = $this->academicCalendarRepository->getAllAcademicCalendars();
        $rooms = $this->roomRepository->getAllRooms();

        return view('pages.proposal.create', compact('students', 'lectures', 'academicCalendars', 'rooms'));
    }

    public function store(StoreProposalRequest $request)
    {
        $this->proposalRepository->createProposal($request->validated());

        Alert::success('Sukses', 'Data Proposal Berhasil Ditambahkan');

        return redirect()->route('proposals.index');
    }

    public function edit($id)
    {
        if (!Auth::user()->can('edit-proposal')) {
            abort(403, 'Unauthorized action.');
        }

        $proposal = $this->proposalRepository->getProposalById($id);
        $students = $this->studentRepository->getAllStudents();
        $lectures = $this->lectureRepository->getAllLectures();
        $academicCalendars = $this->academicCalendarRepository->getAllAcademicCalendars();
        $rooms = $this->roomRepository->getAllRooms();

        return view('pages.proposal.edit', compact('proposal', 'students', 'lectures', 'academicCalendars', 'rooms'));
    }

    public function update(UpdateProposalRequest $request, $id)
    {
        $this->proposalRepository->updateProposal($id, $request->validated());

        Alert::success('Sukses', 'Data Proposal Berhasil Diubah');

        return redirect()->route('proposals.index');
    }

    public function destroy($id)
    {
        $this->proposalRepository->deleteProposal($id);

        Alert::success('Sukses', 'Data Proposal Berhasil Dihapus');

        return redirect()->route('proposals.index');
    }
}
