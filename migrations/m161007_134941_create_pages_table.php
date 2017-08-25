<?php

use yii\db\Migration;

/**
 * Handles the creation for table `pages`.
 */
class m161007_134941_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'description_ru' => $this->text(),
            'description_ua' => $this->text(),
            'description_en' => $this->text(),

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
        $this->dropTable('pages');
    }
}
