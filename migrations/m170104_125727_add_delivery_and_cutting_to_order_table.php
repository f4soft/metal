<?php

use yii\db\Migration;

class m170104_125727_add_delivery_and_cutting_to_order_table extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'delivery', $this->boolean()->defaultValue(0));
        $this->addColumn('orders', 'cutting', $this->boolean()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('orders', 'delivery');
        $this->dropColumn('orders', 'cutting');

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
