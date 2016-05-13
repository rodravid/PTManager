<?php

namespace App\Providers;

use App\Repositories\ProjectRepository;
use App\Interfaces\ProjectRepositoryInterface;

use App\Repositories\TaskRepository;
use App\Interfaces\TaskRepositoryInterface;

use App\Interfaces\MainRepositoryInterface;
use App\Repositories\MainRepository;

use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->singleton(MainRepositoryInterface::class, MainRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

    }
}
