<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 */
class m221128_162812_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('items', [
            'id' => $this->primaryKey(),
            'real_id' => $this->string()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'barcodes' => $this->text()->null(),
            'manufacturer' => $this->string(255)->null(),
            'quantity' => $this->float(3)->notNull(),
            'price' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);

        $this->createIndex(
            'idx-items-real_id',
            'items',
            'real_id'
        );

        $this->createIndex(
            'idx-items-order_id',
            'items',
            'order_id'
        );

        $this->addForeignKey(
            'fk-items-order_id',
            'items',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-items-order_id', 'items');
        $this->dropIndex('idx-items-order_id','items');
        $this->dropIndex('idx-items-real_id', 'items');

        $this->dropTable('items');
    }
}
