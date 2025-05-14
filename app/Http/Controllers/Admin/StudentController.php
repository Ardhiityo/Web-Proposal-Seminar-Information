<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\StudentInterface;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Services\Interfaces\StudyProgramInterface;
use App\Http\Requests\Student\UpdateStudentRequest;

class StudentController extends Controller
{

    public function __construct(
        private StudentInterface $studentRepository,
        private StudyProgramInterface $studyProgramRepository
    ) {}


    public function index()
    {
        $students = $this->studentRepository->getAllStudents();

        return view('pages.student.index', compact('students'));
    }

    public function create()
    {
        $studyPrograms = $this->studyProgramRepository->getAllStudyPrograms();

        return view('pages.student.create', compact('studyPrograms'));
    }

    public function store(StoreStudentRequest $request)
    {
        $this->studentRepository->createStudent($request->validated());

        Alert::success('Sukses', 'Data Mahasiswa Berhasil Ditambahkan');

        return redirect()->route('students.index');
    }

    public function edit($id)
    {
        $student = $this->studentRepository->getStudentById($id);
        $studyPrograms = $this->studyProgramRepository->getAllStudyPrograms();

        return view('pages.student.edit', compact('student', 'studyPrograms'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $this->studentRepository->updateStudent($id, $request->validated());

        Alert::success('Sukses', 'Data Mahasiswa Berhasil Diperbarui');

        return redirect()->route('students.index');
    }


    public function destroy($id)
    {
        $this->studentRepository->deleteStudent($id);

        Alert::success('Sukses', 'Data Mahasiswa Berhasil Dihapus');

        return redirect()->route('students.index');
    }
}
