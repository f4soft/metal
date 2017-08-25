<?php

use yii\db\Migration;

/**
 * Handles the creation for table `articles`.
 */
class m161020_163314_create_articles_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'description_ru' => $this->text(),
            'description_ua' => $this->text(),
            'description_en' => $this->text(),

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

            'alias' => $this->string(),
            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('articles');
    }
}
