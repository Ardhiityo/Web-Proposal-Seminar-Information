<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        return view('pages.academic-calendar.index');
    }

    public function create()
    {
        return view('pages.academic-calendar.create');
    }
}
