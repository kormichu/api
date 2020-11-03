<?php

namespace App\Providers;

use Common\Application\CommandBus;
use Common\Application\Handler\Handler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Generator\IdGenerator;
use Infrastructure\Generator\UuidGenerator;
use Psr\Log\LoggerInterface;

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
        $this->app->singleton(CommandBus::class, function(Application $app) {
            $services = $app->tagged(Handler::class);
            if(!is_array($services)) {
                $services = iterator_to_array($services);
            }
            return new CommandBus($app->make(LoggerInterface::class), $services);
        });
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
