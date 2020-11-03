<?php

declare(strict_types=1);

namespace Api\Application\Handler;

use Api\Application\Command\CreateProduct;
use Api\Domain\Factory\ProductFactory;
use Api\Domain\Model\ProductRepository;
use Common\Application\Command\Command;
use Common\Application\Handler\Handler;
use Psr\Log\LoggerInterface;

class CreateProductHandler implements Handler
{
    private ProductFactory $productFactory;
    private ProductRepository $productRepository;
    private LoggerInterface $logger;

    /**
     * @param ProductFactory $productFactory
     * @param ProductRepository $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(ProductFactory $productFactory,
                                ProductRepository $productRepository,
                                LoggerInterface $logger
    ) {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * @param CreateProduct|Command $command
     */
    public function handle(Command $command): void
    {
        $context = $command->getContext();

        $product = $this->productFactory->createNew(
            $command->getProductId(),
            $command->getProductName(),
            $command->getProductPrice(),
            $command->getCurrencyName()
        );
        $this->productRepository->save($product);

        $this->logger->info('The product has been created', $context);
    }

    /**
     * {@inheritDoc}
     */
    public function getSupportedCommands(): array
    {
        return [
            CreateProduct::class
        ];
    }
}
