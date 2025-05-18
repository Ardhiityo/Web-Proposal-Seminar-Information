<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\ProposalController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('lectures', LectureController::class);
    Route::resource('students', StudentController::class);
    Route::resource('study-programs', StudyProgramController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('academic-calendars', AcademicCalendarController::class);
    Route::resource('proposals', ProposalController::class);
    Route::resource('periodes', PeriodeController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // History
    Route::delete('/history', [HistoryController::class, 'destroy'])->name('history.destroy');
});

require __DIR__ . '/auth.php';
