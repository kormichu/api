<?php

namespace App\Providers;

use Api\Application\Handler\CreateProductHandler;
use Api\Domain\Model\ProductRepository;
use Common\Application\Handler\Handler;
use Illuminate\Support\ServiceProvider;

class ApiProvider extends ServiceProvider
{
    public $bindings = [
        ProductRepository::class => \Api\Infrastructure\Eloquent\Repository\ProductRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CreateProductHandler::class);
        $this->app->tag([CreateProductHandler::class], [Handler::class]);
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
