<?php

namespace App\Services;

use App\Http\Resources\Products\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService extends BaseService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function getProducts(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->productRepository->getProducts());
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function getProductById(int $id): ProductResource
    {
        return ProductResource::make($this->productRepository->getProductById($id));
    }
}
