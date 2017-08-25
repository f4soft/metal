<?php

use yii\db\Migration;

class m170413_073254_alter_block_settings_table_add_vacancies_banner extends Migration
{
    public function up()
    {
        $this->addColumn('block_settings', 'vacancies_banner_ru', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'vacancies_banner_ua', $this->string()->defaultValue(''));
        $this->addColumn('block_settings', 'vacancies_banner_en', $this->string()->defaultValue(''));
    }

    public function down()
    {
        echo "m170413_073254_alter_block_settings_table_add_vacancies_banner reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
