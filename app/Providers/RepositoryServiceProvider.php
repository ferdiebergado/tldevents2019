<?php

namespace App\Providers;

use App\Repositories\EventEloquentRepository;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\ParticipantEloquentRepository;
use App\Repositories\ParticipantRepositoryInterface;
use App\Repositories\TransactionEloquentRepository;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventRepositoryInterface::class, EventEloquentRepository::class);
        $this->app->bind(ParticipantRepositoryInterface::class, ParticipantEloquentRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionEloquentRepository::class);
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
