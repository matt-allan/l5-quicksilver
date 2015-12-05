<?php

namespace App\Providers;

use App\Storage\DoctrineCustomerRepository;
use App\Storage\DoctrineDeliveryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Quicksilver\Application\Auth\Guard;
use Quicksilver\Domain;

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
        $this->app->bind(Domain\Delivery\Repository::class, function (Application $app) {
            return new DoctrineDeliveryRepository(
                $app->make('em'),
                $app->make('em')->getClassMetaData(Domain\Delivery::class)
            );
        });

        $this->app->bind(Domain\Customer\Repository::class, function (Application $app) {
            return new DoctrineCustomerRepository(
                $app->make('em'),
                $app->make('em')->getClassMetaData(Domain\Customer::class)
            );
        });

        $this->app->bind(Guard::class, function (Application $app) {
            return new \App\Auth\Guard();
        });
    }
}
