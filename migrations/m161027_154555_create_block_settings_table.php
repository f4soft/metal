<?php

use yii\db\Migration;

/**
 * Handles the creation for table `block_settings`.
 */
class m161027_154555_create_block_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('block_settings', [
            'id' => $this->primaryKey(),
            'presscenter_price' => $this->string(),
            'presscenter_price_image' => $this->string(),
            'presscenter_price_image_alt_ru' => $this->string(),
            'presscenter_price_image_alt_ua' => $this->string(),
            'presscenter_price_image_alt_en' => $this->string(),
            'presscenter_price_image_title_ru' => $this->string(),
            'presscenter_price_image_title_ua' => $this->string(),
            'presscenter_price_image_title_en' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('block_settings');
    }
}
