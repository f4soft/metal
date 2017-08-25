<?php

use yii\db\Migration;

/**
 * Handles the creation for table `departments`.
 */
class m161006_141323_create_departments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%departments}}', [
            'id' => $this->primaryKey(),

            'title_ru' => $this->string(),
            'title_ua' => $this->string(),
            'title_en' => $this->string(),

            'phone' => $this->string(),
            'email' => $this->string(),
            'leader_fio_ru' => $this->string(),
            'leader_fio_ua' => $this->string(),
            'leader_fio_en' => $this->string(),

            'office_id' => $this->integer()->notNull(),
            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-departments-office_id',
            'departments',
            'office_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('departments');
    }
}
