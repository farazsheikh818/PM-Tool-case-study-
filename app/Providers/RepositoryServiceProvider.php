<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\IRepositories\IProjectRepository;
use App\Repositories\ProjectRepository;
use App\IRepositories\ITaskRepository;
use App\Repositories\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IProjectRepository::class, ProjectRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
