<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedback`.
 */
class m161110_081535_create_feedback_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),

            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'message' => $this->text(),

            'status' => $this->integer()->defaultValue(0),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feedback');
    }
}
