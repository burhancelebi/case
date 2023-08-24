<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository
{
    /**
     * @var int
     */
    private int $customer_id;

    /**
     * @var float
     */
    private float $total;

    /** @var Order */
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOrders(): LengthAwarePaginator
    {
        return $this->order->newQuery()->paginate(request()->get('per_page'));
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function getOrderById(int $id): Model|Collection|Builder|array|null
    {
        return $this->order->newQuery()->findOrFail($id);
    }

    public function destroy(int $id)
    {
        return $this->order->newQuery()->where('id', $id)->delete();
    }
}
