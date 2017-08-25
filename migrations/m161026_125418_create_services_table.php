<?php

use yii\db\Migration;

/**
 * Handles the creation for table `services`.
 */
class m161026_125418_create_services_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'description_ru' => $this->text(),
            'description_ua' => $this->text(),
            'description_en' => $this->text(),

            'big_image' => $this->string(),

            'small_image' => $this->string(),
            'small_image_alt_ru'=> $this->string(),
            'small_image_alt_ua'=> $this->string(),
            'small_image_alt_en'=> $this->string(),
            'small_image_title_ru'=> $this->string(),
            'small_image_title_ua'=> $this->string(),
            'small_image_title_en'=> $this->string(),

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
        $this->dropTable('services');
    }
}
