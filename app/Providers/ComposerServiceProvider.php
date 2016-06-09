<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
                    'task.editTask',
                    'task.tasks'
                ],
            'App\ViewComposers\TaskComposer');

        view()->composer([
                    'project.editProject',
                    'project.projects',
                    'task.editTask',
                    'task.tasks'
                ],
            'App\ViewComposers\UserComposer');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}