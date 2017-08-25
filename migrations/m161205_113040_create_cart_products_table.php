<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart_products`.
 */
class m161205_113040_create_cart_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart_products', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->float(),
            'unit' => $this->string(),
            'unit_value' => $this->float(),
            'count' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart_products');
    }
}
