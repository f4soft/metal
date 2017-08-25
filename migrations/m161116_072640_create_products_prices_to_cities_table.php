<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_prices_to_cities`.
 */
class m161116_072640_create_products_prices_to_cities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products_prices_to_cities', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->float(),

            'description_ru' => $this->text(),
            'description_ua' => $this->text(),
            'description_en' => $this->text(),

            'coefficient' => $this->float(),

            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-products_prices_to_cities-city_id',
            'products_prices_to_cities',
            'city_id'
        );

        $this->createIndex(
            'idx-products_prices_to_cities-product_id',
            'products_prices_to_cities',
            'product_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products_prices_to_cities');
    }
}
