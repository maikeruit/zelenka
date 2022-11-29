<?php

namespace app\commands;

use app\common\exceptions\ReceiverException;
use app\common\giver\Giver;
use app\common\parser\Parser;
use app\common\receiver\Receiver;
use app\models\Order;
use yii\console\Controller;
use yii\console\ExitCode;

class OrderController extends Controller
{
    /**
     * @throws ReceiverException
     */
    public function actionUpdateNet(string $url): int
    {
        $receiver = new Receiver($url);
        $items = $receiver->receiveFromUrl();

        $parser = new Parser();
        $parser->execute($items['orders']);

        return ExitCode::OK;
    }

    /**
     * @throws ReceiverException
     */
    public function actionUpdateLocal(string $path): int
    {
        $receiver = new Receiver($path);
        $items = $receiver->receiverFromPath();

        $parser = new Parser();
        $parser->execute($items['orders']);

        return ExitCode::OK;
    }

    public function actionInfo(int $orderId): int
    {
        $order = Order::findOne(['real_id' => $orderId]);
        $giver = new Giver($order);

        echo $giver->getJson() . PHP_EOL;

        return ExitCode::OK;
    }
}