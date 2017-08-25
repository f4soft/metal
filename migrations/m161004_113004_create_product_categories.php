<?php

use yii\db\Migration;

class m161004_113004_create_product_categories extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === "mysql") {
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }

        $this->createTable('{{%products_categories}}', [
            'id' => $this->primaryKey(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'tree' => $this->integer()->notNull(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'image' => $this->string(),
            'image_alt_ru'=> $this->string(),
            'image_alt_ua'=> $this->string(),
            'image_alt_en'=> $this->string(),
            'image_title_ru'=> $this->string(),
            'image_title_ua'=> $this->string(),
            'image_title_en'=> $this->string(),

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

            'external_id' => $this->string(),
            'related_categories_id' => $this->string(),

            'status' => $this->boolean()->defaultValue(0)->notNull(),
            'alias' => $this->string()->notNull(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),

        ], $tableOptions);
    }

    public function down()
    {
        echo "m161004_113004_create_product_categories cannot be reverted.\n";

        return false;
    }
}
