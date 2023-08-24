<?php

namespace App\Rules;

use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductStockControlRule implements ValidationRule
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = $this->productService->getProductById($value);

        if ($product->stock < request()->get('quantity'))
        {
            $fail('There are only ' . $product->stock .' of this product in stock');
        }
    }
}
