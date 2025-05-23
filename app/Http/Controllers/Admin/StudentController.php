<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Jobs\ImportStudentJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Requests\Excel\StoreStudentImportRequest;

class StudentController extends Controller
{
    public function __construct(
        private StudentInterface $studentRepository,
        private LectureInterface $lectureRepository
    ) {}

    public function index(Request $request)
    {
        if ($keyword = $request->query('keyword')) {
            $students = $this->studentRepository->getAllStudentsByKeyword($keyword);
        } else {
            $students = $this->studentRepository->getAllStudentsByPaginate();
        }

        return view('pages.student.index', compact('students'));
    }

    public function create()
    {
        if (!Auth::user()->can('create-student')) {
            abort(403, 'Unauthorized action.');
        }

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
        if (!Auth::user()->can('update-student')) {
            abort(403, 'Unauthorized action.');
        }

        $student = $this->studentRepository->getStudentById($id);
        $lectures = $this->lectureRepository->getAllLectures();

        return view('pages.student.edit', compact('student', 'lectures'));
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
            $path = $request->file('excel')->store('excel/student', 'public');
            ImportStudentJob::dispatch($path);
            Alert::success('Sukses', 'Sedang diproses, refresh halaman secara berkala.');

            return redirect()->route('students.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengunggah file');

            return redirect()->route('students.index');
        }
    }
}
