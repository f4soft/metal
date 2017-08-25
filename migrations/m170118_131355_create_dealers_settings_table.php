<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dealers_settings`.
 */
class m170118_131355_create_dealers_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dealers_settings', [
            'id' => $this->primaryKey(),
            'dealers_title_ru' => $this->string(),
            'dealers_title_ua' => $this->string(),
            'dealers_title_en' => $this->string(),
            'dealers_page_description_ru' => $this->text(),
            'dealers_page_description_ua' => $this->text(),
            'dealers_page_description_en' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dealers_settings');
    }
}
