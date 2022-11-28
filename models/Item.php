<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $real_id
 * @property int $order_id
 * @property string $name
 * @property string $barcodes
 * @property string $manufacturer
 * @property float $quantity
 * @property int $price
 * @property int $amount
 * @property string $updated_at
 *
 * @property Order $order
 */
class Item extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['real_id', 'order_id', 'name', 'quantity', 'price', 'amount'], 'required'],
            [['order_id', 'price', 'amount'], 'integer'],
            [['barcodes'], 'string'],
            [['quantity'], 'number'],
            [['updated_at'], 'safe'],
            [['real_id', 'name', 'manufacturer'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'real_id' => 'Real ID',
            'order_id' => 'Order ID',
            'name' => 'Name',
            'barcodes' => 'Barcodes',
            'manufacturer' => 'Manufacturer',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'amount' => 'Amount',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
