<?php

use yii\db\Migration;

class m161003_132557_team_init extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === "mysql") {
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }

        $this->createTable("{{%team}}", [
            "id" => $this->primaryKey(),
            "image" => $this->string(),
            "image_alt_en" => $this->string(),
            "image_alt_ru" => $this->string(),
            "image_alt_ua" => $this->string(),
            "image_title_en" => $this->string(),
            "image_title_ru" => $this->string(),
            "image_title_ua" => $this->string(),
            'fname_ru' => $this->string(),
            'fname_en' => $this->string(),
            'fname_ua' => $this->string(),
            'lname_ru' => $this->string(),
            'lname_en' => $this->string(),
            'lname_ua' => $this->string(),
            'sname_ru' => $this->string(),
            'sname_en' => $this->string(),
            'sname_ua' => $this->string(),
            'position_ru' => $this->string(),
            'position_en' => $this->string(),
            'position_ua' => $this->string(),
            'email' => $this->string()->notNull(),
            'work_phone' => $this->string()->notNull(),
            'mobile_phone' => $this->string()->notNull(),
            'status' => $this->boolean()->defaultValue(0)->notNull(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m161003_132557_team_init cannot be reverted.\n";

        return false;
    }
}
