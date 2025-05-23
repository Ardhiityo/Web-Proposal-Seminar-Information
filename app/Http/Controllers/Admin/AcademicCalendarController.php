<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Interfaces\AcademicCalendarInterface;
use App\Http\Requests\AcademicCalendar\StoreAcademicCalendarRequest;
use App\Http\Requests\AcademicCalendar\UpdateAcademicCalendarRequest;

class AcademicCalendarController extends Controller
{
    public function __construct(private AcademicCalendarInterface $academicCalendarRepository) {}

    public function index()
    {
        $academicCalendars = $this->academicCalendarRepository->getAllAcademicCalendarsByPaginate();

        return view('pages.academic-calendar.index', compact('academicCalendars'));
    }

    public function create()
    {
        if (!Auth::user()->can('create-academic-calendar')) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.academic-calendar.create');
    }

    public function store(StoreAcademicCalendarRequest $request)
    {
        $this->academicCalendarRepository->createAcademicCalendar($request->validated());

        Alert::success('Sukses', text: 'Data Tahun Akademik Berhasil Ditambahkan');

        return redirect()->route('academic-calendars.index');
    }

    public function edit($id)
    {
        if (!Auth::user()->can('update-academic-calendar')) {
            abort(403, 'Unauthorized action.');
        }

        $academicCalendar = $this->academicCalendarRepository->getAcademicCalendarById($id);

        return view('pages.academic-calendar.edit', compact('academicCalendar'));
    }

    public function update(UpdateAcademicCalendarRequest $request, $id)
    {
        $this->academicCalendarRepository->updateAcademicCalendar($id, $request->validated());

        Alert::success('Sukses', text: 'Data Tahun Akademik Berhasil Diubah');

        return redirect()->route('academic-calendars.index');
    }

    public function destroy($id)
    {
        $this->academicCalendarRepository->deleteAcademicCalendar($id);

        Alert::success('Sukses', text: 'Data Tahun Akademik Berhasil Dihapus');

        return redirect()->route('academic-calendars.index');
    }
}
