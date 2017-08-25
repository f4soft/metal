<?php

use yii\db\Migration;

class m161028_140634_alter_block_settings_table extends Migration
{
    public function up()
    {
        $table = "{{%block_settings}}";

        $this->addColumn($table, 'vacancy_description_ru', $this->string());
        $this->addColumn($table, 'vacancy_description_ua', $this->string());
        $this->addColumn($table, 'vacancy_description_en', $this->string());

        $this->addColumn($table, 'vacancy_offer_description_ru', $this->text());
        $this->addColumn($table, 'vacancy_offer_description_ua', $this->text());
        $this->addColumn($table, 'vacancy_offer_description_en', $this->text());

        $this->addColumn($table, 'services_description_ru', $this->text());
        $this->addColumn($table, 'services_description_ua', $this->text());
        $this->addColumn($table, 'services_description_en', $this->text());

        $this->addColumn($table, 'services_offer_description_ru', $this->text());
        $this->addColumn($table, 'services_offer_description_ua', $this->text());
        $this->addColumn($table, 'services_offer_description_en', $this->text());

        $this->addColumn($table, 'about_main_description_ru', $this->text());
        $this->addColumn($table, 'about_main_description_ua', $this->text());
        $this->addColumn($table, 'about_main_description_en', $this->text());

        $this->addColumn($table, 'about_mission_description_ru', $this->text());
        $this->addColumn($table, 'about_mission_description_ua', $this->text());
        $this->addColumn($table, 'about_mission_description_en', $this->text());

        $this->addColumn($table, 'about_strategy_description_ru', $this->text());
        $this->addColumn($table, 'about_strategy_description_ua', $this->text());
        $this->addColumn($table, 'about_strategy_description_en', $this->text());

        $this->addColumn($table, 'our_goal_description_ru', $this->text());
        $this->addColumn($table, 'our_goal_description_ua', $this->text());
        $this->addColumn($table, 'our_goal_description_en', $this->text());

        $this->addColumn($table, 'offices_description_ru', $this->text());
        $this->addColumn($table, 'offices_description_ua', $this->text());
        $this->addColumn($table, 'offices_description_en', $this->text());
    }

    public function down()
    {
        echo "m161028_140634_alter_block_settings_table cannot be reverted.\n";

        return false;
    }
}
