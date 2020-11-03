<?php

namespace App\Providers;

use Api\Application\Command\CreateProduct;
use Api\Application\Handler\CreateProductHandler;
use Api\Domain\Model\ProductRepository;
use Common\Application\CommandBus;
use Illuminate\Support\ServiceProvider;

class ApiProvider extends ServiceProvider
{
    public $bindings = [
        CreateProductHandler::class => CreateProductHandler::class,
        ProductRepository::class => \Api\Infrastructure\Eloquent\Repository\ProductRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var CommandBus $commandBus */
        $commandBus = $this->app->get(CommandBus::class);
        $commandBus->registerHandler(CreateProduct::class, $this->app->get(CreateProductHandler::class));
    }
}
