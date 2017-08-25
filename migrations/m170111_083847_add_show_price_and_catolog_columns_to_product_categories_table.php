<?php

use yii\db\Migration;

/**
 * Handles adding show_price_and_catolog to table `product_categories`.
 */
class m170111_083847_add_show_price_and_catolog_columns_to_product_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('products_categories', 'show_price', $this->boolean()->defaultValue(1));
        $this->addColumn('products_categories', 'show_catalog', $this->boolean()->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('products_categories', 'show_price');
        $this->dropColumn('products_categories', 'show_catalog');
    }
}
