<?php

namespace App\Providers;

use App\Services\Interfaces\LectureInterface;
use App\Services\Interfaces\StudentInterface;
use App\Services\Interfaces\StudyProgramInterface;
use App\Services\Repositories\LectureRepository;
use App\Services\Repositories\StudentRepository;
use App\Services\Repositories\StudyProgramRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
