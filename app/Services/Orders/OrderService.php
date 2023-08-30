<?php

namespace App\Services\Orders;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Repositories\Orders\OrderRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    /** @var OrderRepository  */
    private OrderRepository $orderRepository;

    /** @var OrderItemService  */
    private OrderItemService $itemService;

    public function __construct(OrderRepository $orderRepository,
                                OrderItemService $itemService)
    {
        $this->orderRepository = $orderRepository;
        $this->itemService = $itemService;
    }

    /**
     * @param CreateOrderRequest $request
     * @return OrderResource|JsonResponse
     */
    public function store(CreateOrderRequest $request): JsonResponse|OrderResource
    {
        try {
            DB::beginTransaction();
            $this->orderRepository->setCustomerId($request->get('customer_id'));

            /** @var Order|Model|Builder $order */
            $order = $this->orderRepository->store();
            $this->itemService->store($request, $order);
            DB::commit();

            return OrderResource::make($order);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getOrderWithItems(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderRepository->getOrderWithItems());
    }

    /**
     * @param int $id
     * @return OrderResource
     */
    public function getOrderById(int $id): OrderResource
    {
        return OrderResource::make($this->orderRepository->getOrderById($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->getOrderById($id);
            $order->delete();
            $this->itemService->destroyByOrderId($id);
            DB::commit();

            return response()->json([
                'message' => 'Order Deleted'
            ]);

        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
