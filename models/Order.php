<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $real_id
 * @property string $user_name
 * @property string $user_phone
 * @property int $warehouse_id
 * @property string $created_at
 * @property int $status
 * @property int $is_paid
 * @property string|null $promocode
 * @property int $type
 * @property string $updated_at
 *
 * @property Item[] $items
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['real_id', 'user_phone', 'warehouse_id', 'created_at', 'status', 'is_paid', 'type'], 'required'],
            [['real_id', 'status', 'is_paid', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_name', 'user_phone', 'warehouse_id', 'promocode'], 'string', 'max' => 255],
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
            'user_name' => 'User Name',
            'user_phone' => 'User Phone',
            'warehouse_id' => 'Warehouse ID',
            'created_at' => 'Created At',
            'status' => 'Status',
            'is_paid' => 'Is Paid',
            'promocode' => 'Promocode',
            'type' => 'Type',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['order_id' => 'id']);
    }
}
