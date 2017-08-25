<?php

use yii\db\Migration;

class m170117_095346_add_weight_to_cart_products_table extends Migration
{
    public function up()
    {
        $this->addColumn('cart_products', 'weight', $this->float()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('cart_products', 'weight');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
