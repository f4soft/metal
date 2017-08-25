<?php

use yii\db\Migration;

class m161208_135946_alter_products_table extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'unit_key', $this->string());
    }

    public function down()
    {
        echo "m161208_135946_alter_products_table cannot be reverted.\n";

        return false;
    }
}
