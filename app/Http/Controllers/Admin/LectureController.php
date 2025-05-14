<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\LectureInterface;
use Illuminate\Http\Request;

class LectureController extends Controller
{

    public function __construct(private LectureInterface $lectureRepository) {}

    public function index()
    {
        $lectures = $this->lectureRepository->getAllLectures();

        return view('pages.lecture.index', compact('lectures'));
    }

    public function create()
    {
        return view('pages.lecture.create');
    }
}
