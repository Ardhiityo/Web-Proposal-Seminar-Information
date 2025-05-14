<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\StudyProgramInterface;
use App\Http\Requests\StudyProgram\StoreStudyProgramRequest;

class StudyProgramController extends Controller
{
    public function __construct(private StudyProgramInterface $studyProgramRepository) {}

    public function index()
    {
        $studyPrograms = $this->studyProgramRepository->getAllStudyPrograms();

        return view('pages.study-program.index', compact('studyPrograms'));
    }

    public function create()
    {
        return view('pages.study-program.create');
    }

    public function store(StoreStudyProgramRequest $request)
    {
        $this->studyProgramRepository->createStudyProgram($request->validated());

        Alert::success('Sukses', 'Data Program Studi Berhasil Ditambahkan');

        return redirect()->route('study-programs.index');
    }

    public function destroy($id)
    {
        $this->studyProgramRepository->deleteStudyProgram($id);

        Alert::success('Sukses', 'Data Program Studi Berhasil Dihapus');

        return redirect()->route('study-programs.index');
    }
}
