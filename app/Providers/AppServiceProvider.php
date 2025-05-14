<?php

namespace App\Providers;

use App\Services\Interfaces\LectureInterface;
use App\Services\Repositories\LectureRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LectureInterface::class, LectureRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
