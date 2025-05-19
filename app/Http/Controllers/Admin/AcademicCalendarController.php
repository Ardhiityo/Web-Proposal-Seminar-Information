<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicCalendar\StoreAcademicCalendarRequest;
use App\Http\Requests\AcademicCalendar\UpdateAcademicCalendarRequest;
use App\Services\Interfaces\AcademicCalendarInterface;
use RealRashid\SweetAlert\Facades\Alert;

class AcademicCalendarController extends Controller
{

    public function __construct(private AcademicCalendarInterface $academicCalendarRepository) {}

    public function index()
    {
        $academicCalendars = $this->academicCalendarRepository->getAllAcademicCalendars();

        return view('pages.academic-calendar.index', compact('academicCalendars'));
    }

    public function create()
    {
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
