<?php

namespace app\common\giver;

use app\models\Order;

class Giver implements GiverInterface
{
    public function __construct(private Order $order)
    {

    }

    public function getJson(int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE): string
    {
        $data = [];

        if ($this->order) {
            $data = [
                'id' => $this->order->real_id,
                'real_id' => $this->order->real_id,
                'user_name' => $this->order->user_name,
                'user_phone' => $this->order->user_phone,
                'warehouse_id' => $this->order->warehouse_id,
                'created_at' => $this->order->created_at,
                'updated_at' => $this->order->updated_at,
                'status' => $this->order->status,
                'items_count' => $this->order->getItems()->count()
            ];
        }

        return json_encode($data, $flags);
    }
}