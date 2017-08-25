<?php

use yii\db\Migration;

class m161216_083346_alter_block_settings_table extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'about_image', $this->string());

        $this->addColumn('block_settings', 'about_image_alt_ru', $this->string());
        $this->addColumn('block_settings', 'about_image_alt_ua', $this->string());
        $this->addColumn('block_settings', 'about_image_alt_en', $this->string());

        $this->addColumn('block_settings', 'about_image_title_ru', $this->string());
        $this->addColumn('block_settings', 'about_image_title_ua', $this->string());
        $this->addColumn('block_settings', 'about_image_title_en', $this->string());

        $this->addColumn('block_settings', 'about_main_page_description_ru', $this->text());
        $this->addColumn('block_settings', 'about_main_page_description_ua', $this->text());
        $this->addColumn('block_settings', 'about_main_page_description_en', $this->text());

        /*$this->update('block_settings' , [
            'about_main_page_description_ru' => \Faker\Provider\Lorem::sentences(3),
            'about_main_page_description_ua' => \Faker\Provider\Lorem::sentences(3),
            'about_main_page_description_en' => \Faker\Provider\Lorem::sentences(3),
        ], 'id=1');*/
    }

    public function down()
    {
        echo "m161216_083346_alter_block_settings_table cannot be reverted.\n";

        return false;
    }
}
