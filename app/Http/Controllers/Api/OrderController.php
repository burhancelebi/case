<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Services\Orders\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->orderService->getOrderWithItems();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request): OrderResource
    {
        return $this->orderService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): OrderResource
    {
        return $this->orderService->getOrderById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->orderService->destroy($id);
    }
}
