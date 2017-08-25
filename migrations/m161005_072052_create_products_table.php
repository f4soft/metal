<?php

use yii\db\Migration;

/**
 * Handles the creation for table `products`.
 */
class m161005_072052_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === "mysql") {
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),

            'external_id' => $this->string(),
            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'sku' => $this->string(),
            'count' => $this->integer(),
            'category_id' => $this->integer()->notNull(),
            'unit' => $this->string(),
            'diameter' => $this->float(),
            'length' => $this->float(),
            'width' => $this->float(),
            'height' => $this->float(),
            'depth' => $this->float(),
            'aisi' => $this->string(),
            'cut_price' => $this->float(),

            'image' => $this->string(),
            'image_alt_ru' => $this->string(),
            'image_alt_ua' => $this->string(),
            'image_alt_en' => $this->string(),
            'image_title_ru' => $this->string(),
            'image_title_ua' => $this->string(),
            'image_title_en' => $this->string(),

            'meta_keywords_ru' => $this->string(),
            'meta_keywords_ua' => $this->string(),
            'meta_keywords_en' => $this->string(),
            'meta_description_ru' => $this->string(),
            'meta_description_ua' => $this->string(),
            'meta_description_en' => $this->string(),

            'article_title_ru' => $this->string(),
            'article_title_ua' => $this->string(),
            'article_title_en' => $this->string(),

            'article_description_ru' => $this->text(),
            'article_description_ua' => $this->text(),
            'article_description_en' => $this->text(),

            'alias' => $this->string(),
            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ],$tableOptions);

        $this->createIndex(
            'idx-products-category_id',
            'products',
            'category_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products');
    }
}