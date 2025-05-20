<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\LectureImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\StoreLectureImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\LectureInterface;
use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;

class LectureController extends Controller
{
    public function __construct(private LectureInterface $lectureRepository) {}

    public function index(Request $request)
    {
        if ($keyword = $request->query('keyword')) {
            $lectures = $this->lectureRepository->getAllLecturesByKeyword($keyword);
        } else {
            $lectures = $this->lectureRepository->getAllLecturesByPaginate();
        }

        return view('pages.lecture.index', compact('lectures'));
    }

    public function create()
    {
        return view('pages.lecture.create');
    }

    public function store(StoreLectureRequest $request)
    {
        $this->lectureRepository->createLecture($request->validated());

        Alert::success('Sukses', 'Data Dosen Berhasil Ditambahkan');

        return redirect()->route('lectures.index');
    }

    public function edit($id)
    {
        $lecture = $this->lectureRepository->getLectureById($id);

        return view('pages.lecture.edit', compact('lecture'));
    }

    public function update(UpdateLectureRequest $request, $id)
    {
        $this->lectureRepository->updateLecture($id, $request->validated());

        Alert::success('Sukses', 'Data Dosen Berhasil Diubah');

        return redirect()->route('lectures.index');
    }

    public function destroy($id)
    {
        $this->lectureRepository->deleteLecture($id);

        Alert::success('Sukses', 'Data Dosen Berhasil Dihapus');

        return redirect()->route('lectures.index');
    }

    public function import(StoreLectureImportRequest $request)
    {
        try {
            Excel::import(new LectureImport, $request->file('excel'));
            Alert::success('Sukses', 'Data Dosen Berhasil Diimport');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengimport data: ' . $e->getMessage());
        }

        return redirect()->route('lectures.index');
    }
}
