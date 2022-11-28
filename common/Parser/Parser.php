<?php

namespace app\common\parser;

use app\models\Item;
use app\models\Order;
use Yii;

class Parser implements ParserInterface
{
    public function execute(array $data): void
    {
        foreach ($data as $datum) {
            $order = Order::findOne(['real_id' => $datum['id']]);

            if (!$order) {
                $order = new Order();
            }

            $order->attributes = $datum;

            if ($order->save()) {
                foreach ($datum['items'] as $item) {
                    $orderItem = Item::findOne(['order_id' => $order->id, 'real_id' => $item['id']]);

                    if (!$orderItem) {
                        $orderItem = new Item();
                    }

                    $orderItem->attributes = $item;
                    $orderItem->order_id = $order->id;
                    $orderItem->real_id = $item['id'];
                    $orderItem->price = (int) $item['price'] * 100;
                    $orderItem->amount = (int) $item['amount'] * 100;

                    if (!$orderItem->save()) {
                        Yii::debug('Item create');
                        Yii::debug('Order ID:' . $order->id);
                        Yii::debug('Real ID:' . $item['id']);
                        Yii::debug('Errors: ' . print_r($orderItem->errors, true));
                    }
                }
            } else {
                Yii::debug('Order create');
                Yii::debug('Real ID:' . $datum['id']);
                Yii::debug('Errors: ' . print_r($order->errors, true));
            }
        }
    }
}