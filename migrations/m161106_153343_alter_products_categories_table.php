<?php

use yii\db\Migration;

class m161106_153343_alter_products_categories_table extends Migration
{
    public function up()
    {
        $this->addColumn('products_categories', 'file_catalog', $this->string());
        $this->addColumn('products_categories', 'image_catalog', $this->string());
    }

    public function down()
    {
        echo "m161106_153343_alter_products_categories_table cannot be reverted.\n";

        return false;
    }

}
