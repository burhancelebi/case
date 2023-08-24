<?php

namespace App\Services;

use App\Http\Resources\Orders\OrderResource;
use App\Repositories\OrderRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderService extends BaseService
{
    /** @var OrderRepository  */
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getOrders(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderRepository->getOrders());
    }

    /**
     * @param int $id
     * @return OrderResource
     */
    public function getOrderById(int $id): OrderResource
    {
        return OrderResource::make($this->orderRepository->getOrderById($id));
    }

    public function destroy(int $id)
    {
        return $this->orderRepository->destroy($id);
    }
}
