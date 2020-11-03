<?php

namespace App\Providers;

use Common\Application\CommandBus;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Generator\IdGenerator;
use Infrastructure\Generator\UuidGenerator;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        IdGenerator::class => UuidGenerator::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CommandBus::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
