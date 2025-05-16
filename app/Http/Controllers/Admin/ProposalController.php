<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\RoomInterface;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Interfaces\ProposalInterface;
use App\Http\Requests\Proposal\StoreProposalRequest;
use App\Services\Interfaces\AcademicCalendarInterface;

class ProposalController extends Controller
{
    public function __construct(
        private ProposalInterface $proposalRepository,
        private StudentInterface $studentRepository,
        private LectureInterface $lectureRepository,
        private AcademicCalendarInterface $academicCalendarRepository,
        private RoomInterface $roomRepository
    ) {}

    public function index()
    {
        $proposals = $this->proposalRepository->getAllProposals();

        return view('pages.proposal.index', compact('proposals'));
    }

    public function create()
    {
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
}
