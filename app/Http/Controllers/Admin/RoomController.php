<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return view('pages.room.index');
    }

    public function create()
    {
        return view('pages.room.create');
    }
}
