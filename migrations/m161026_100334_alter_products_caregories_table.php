<?php

use yii\db\Migration;

class m161026_100334_alter_products_caregories_table extends Migration
{
    public function up()
    {
        $this->addColumn('products_categories', 'file_price', $this->string());
        $this->addColumn('products_categories', 'image_price', $this->string());
    }

    public function down()
    {
        echo "m161026_100334_alter_products_caregories_table cannot be reverted.\n";

        return false;
    }
}
