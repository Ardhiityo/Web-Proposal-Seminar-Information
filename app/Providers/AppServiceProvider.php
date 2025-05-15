<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\RoomInterface;
use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Repositories\RoomRepository;
use App\Services\Interfaces\DashboardInterface;
use App\Services\Repositories\LectureRepository;
use App\Services\Repositories\StudentRepository;
use App\Services\Interfaces\StudyProgramInterface;
use App\Services\Repositories\DashboardRepository;
use App\Services\Repositories\StudyProgramRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LectureInterface::class, LectureRepository::class);
        $this->app->singleton(StudentInterface::class, StudentRepository::class);
        $this->app->singleton(StudyProgramInterface::class, StudyProgramRepository::class);
        $this->app->singleton(RoomInterface::class, RoomRepository::class);
        $this->app->singleton(DashboardInterface::class, DashboardRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
