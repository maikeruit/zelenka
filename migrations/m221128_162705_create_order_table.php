<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m221128_162705_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'real_id' => $this->integer()->notNull()->unique(),
            'user_name' => $this->string()->null(),
            'user_phone' => $this->string()->notNull(),
            'warehouse_id' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'is_paid' => $this->boolean()->notNull(),
            'promocode' => $this->string()->null(),
            'type' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-orders-real_id',
            'orders',
            'real_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-orders-real_id', 'orders');
        $this->dropTable('orders');
    }
}
