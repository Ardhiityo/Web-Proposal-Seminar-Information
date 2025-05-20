<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\StoreStudentImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;

class StudentController extends Controller
{
    public function __construct(
        private StudentInterface $studentRepository,
        private LectureInterface $lectureRepository
    ) {}

    public function index()
    {
        $students = $this->studentRepository->getAllStudentsByPaginate();

        return view('pages.student.index', compact('students'));
    }

    public function create()
    {
        $lectures = $this->lectureRepository->getAllLectures();

        return view('pages.student.create', compact('lectures'));
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

        return view('pages.student.edit', compact('student'));
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

    public function import(StoreStudentImportRequest $request)
    {
        try {
            Excel::import(new StudentImport, $request->file('excel'));
            Alert::success('Sukses', 'Data Mahasiswa Berhasil Diimport');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengimport data: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }
}
