<?php

use yii\db\Migration;

class m161130_064250_alter_products_table extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'popular', $this->boolean());
    }

    public function down()
    {
        echo "m161130_064250_alter_products_table cannot be reverted.\n";

        return false;
    }
}
