<?php

namespace App\Providers;

use App\Interfaces\QuestionServiceInterface;
use App\Services\QuestionService;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

    $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
