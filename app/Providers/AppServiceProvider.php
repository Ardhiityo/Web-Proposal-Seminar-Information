<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\RoomInterface;
use App\Services\Interfaces\HistoryInterface;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Repositories\RoomRepository;
use App\Services\Interfaces\ProposalInterface;
use App\Services\Repositories\HistoryRepository;
use App\Services\Repositories\LectureRepository;
use App\Services\Repositories\StudentRepository;
use App\Services\Repositories\ProposalRepository;
use App\Services\Interfaces\AcademicCalendarInterface;
use App\Services\Repositories\AcademicCalendarRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LectureInterface::class, LectureRepository::class);
        $this->app->singleton(StudentInterface::class, StudentRepository::class);
        $this->app->singleton(RoomInterface::class, RoomRepository::class);
        $this->app->singleton(AcademicCalendarInterface::class, AcademicCalendarRepository::class);
        $this->app->singleton(ProposalInterface::class, ProposalRepository::class);
        $this->app->singleton(HistoryInterface::class, HistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
