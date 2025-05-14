<?php

use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudyProgram;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::resource('lectures', LectureController::class);
    Route::resource('students', StudentController::class);
    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('academic-calendars', AcademicCalendarController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
