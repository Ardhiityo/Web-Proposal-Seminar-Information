<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function index()
    {
        return view('pages.study-program.index');
    }
}
