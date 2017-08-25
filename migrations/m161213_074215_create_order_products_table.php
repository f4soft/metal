<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_products`.
 */
class m161213_074215_create_order_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_products', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->float(),
            'unit' => $this->string(),
            'unit_value' => $this->float(),
            'count' => $this->integer(),
            'cut' => $this->boolean()->defaultValue(0),
            'delivery' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m161213_074215_create_order_products_table cannot be reverted.\n";

        return false;
    }
}
