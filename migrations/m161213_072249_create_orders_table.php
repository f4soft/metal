<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m161213_072249_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'sum' => $this->float(),
            'weight' => $this->float(),
            'status' => $this->boolean()->defaultValue(0),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m161213_072249_create_orders_table cannot be reverted.\n";

        return false;
    }
}
