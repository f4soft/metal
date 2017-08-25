<?php

use yii\db\Migration;

class m170330_114558_alter_products_categories_table extends Migration
{
    public function up()
    {
        $this->addColumn('products_categories', 'file_price_ru', $this->string());
        $this->addColumn('products_categories', 'file_price_ua', $this->string());
        $this->addColumn('products_categories', 'file_price_en', $this->string());
        $this->addColumn('products_categories', 'image_price_ru', $this->string());
        $this->addColumn('products_categories', 'image_price_ua', $this->string());
        $this->addColumn('products_categories', 'image_price_en', $this->string());
        $this->addColumn('products_categories', 'file_catalog_ru', $this->string());
        $this->addColumn('products_categories', 'file_catalog_ua', $this->string());
        $this->addColumn('products_categories', 'file_catalog_en', $this->string());
        $this->addColumn('products_categories', 'image_catalog_ru', $this->string());
        $this->addColumn('products_categories', 'image_catalog_ua', $this->string());
        $this->addColumn('products_categories', 'image_catalog_en', $this->string());
    }

    public function down()
    {
        echo "m170330_114558_alter_products_categories_table reverted.\n";

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
