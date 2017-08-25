<?php

use yii\db\Migration;

/**
 * Handles the creation for table `vacancies`.
 */
class m161005_085911_create_vacancies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === "mysql") {
            $tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        }
        $this->createTable('vacancies', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'department_title_ru' => $this->string(),
            'department_title_ua' => $this->string(),
            'department_title_en' => $this->string(),

            'requirements_ru' => $this->text(),
            'requirements_ua' => $this->text(),
            'requirements_en' => $this->text(),

            'description_ru' => $this->text(),
            'description_ua' => $this->text(),
            'description_en' => $this->text(),

            'city_id' => $this->integer(),

            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-vacancies-city_id',
            'vacancies',
            'city_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vacancies');
    }
}
