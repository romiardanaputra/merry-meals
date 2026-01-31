<?php

namespace App\Providers;

use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\GeolocationRepositoryInterface;
use App\Interfaces\MealRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PartnerRepositoryInterface;
use App\Interfaces\SurveyRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\DonationRepository;
use App\Repositories\GeolocationRepository;
use App\Repositories\MealRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\SurveyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            MealRepositoryInterface::class,
            MealRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            PartnerRepositoryInterface::class,
            PartnerRepository::class
        );

        $this->app->bind(
            DonationRepositoryInterface::class,
            DonationRepository::class
        );

        $this->app->bind(
            SurveyRepositoryInterface::class,
            SurveyRepository::class
        );

        $this->app->bind(
            GeolocationRepositoryInterface::class,
            GeolocationRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
