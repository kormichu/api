<?php

namespace App\Http\Controllers\Api;

use Api\Domain\Model\ProductRepository;
use App\Http\Controllers\Controller;
use Common\Application\CommandBus;
use Common\Domain\Model\Id\ProductId;
use Common\Infrastructure\Exception\AggregateNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Infrastructure\Generator\IdGenerator;

class ProductApiController extends Controller
{
    private CommandBus $commandBus;
    private IdGenerator $idGenerator;
    private ProductRepository $productRepository;

    /**
     * @param CommandBus $commandBus
     * @param IdGenerator $idGenerator
     * @param ProductRepository $productRepository
     */
    public function __construct(CommandBus $commandBus,
                                IdGenerator $idGenerator,
                                ProductRepository $productRepository
    ) {
        $this->commandBus = $commandBus;
        $this->idGenerator = $idGenerator;
        $this->productRepository = $productRepository;
    }

    public function fetch(Request $request)
    {
        if(!$request->has('id')) {
            return response('No id parameter', 400);
        }

        try {
            $product = $this->productRepository->get(new ProductId($request->get('id')));
        } catch(AggregateNotFoundException $exc) {
            return response('Not found', 404);
        }

        return response($product->toArray(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [ 'required', 'max:50' ],
            'price' => [ 'required', 'gt:0', 'numeric' ],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response($errors, 400);
        }

        $data = $validator->validate();

        /** @var ProductId $productId */
        $productId = $this->idGenerator->generate(ProductId::class);
        $this->commandBus->handle(
            new \Api\Application\Command\CreateProduct(
                $productId,
                $data['name'],
                $data['price']
            )
        );

        $product = $this->productRepository->get($productId);

        return response($product->toArray(), 201);
    }
}
