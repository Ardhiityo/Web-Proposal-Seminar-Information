<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Imports\LectureImport;
use App\Jobs\ImportLectureJob;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\LectureInterface;
use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;
use App\Http\Requests\Excel\StoreLectureImportRequest;

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
        if (!Auth::user()->can('create-lecture')) {
            abort(403, 'Unauthorized action.');
        }

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
        if (!Auth::user()->can('update-lecture')) {
            abort(403, 'Unauthorized action.');
        }

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

    public function import(Request $request)
    {
        try {
            $path = $request->file('excel')->store('excel/lecture', 'public');
            ImportLectureJob::dispatch($path);
            Alert::success('Sukses', 'Sedang diproses, refresh halaman secara berkala.');

            return redirect()->route('lectures.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal mengunggah file');

            return redirect()->route('lectures.index');
        }
    }
}
