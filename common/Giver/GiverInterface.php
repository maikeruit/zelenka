<?php

namespace app\common\giver;

use app\models\Order;

interface GiverInterface
{
    public function __construct(Order $order);

    public function getJson(int $flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE): string;
}