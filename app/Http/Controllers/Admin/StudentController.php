<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\StudentInterface;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Imports\StudentImport;

class StudentController extends Controller
{

    public function __construct(
        private StudentInterface $studentRepository,
    ) {}

    public function index()
    {
        $students = $this->studentRepository->getAllStudents();

        return view('pages.student.index', compact('students'));
    }

    public function create()
    {
        return view('pages.student.create');
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

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new StudentImport, $request->file('excel'));
            Alert::success('Sukses', 'Data Mahasiswa Berhasil Diimport');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengimport data: ' . $e->getMessage());
        }

        return redirect()->route('students.index');
    }
}
