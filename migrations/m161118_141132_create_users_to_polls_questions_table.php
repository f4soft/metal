<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_to_polls_questions`.
 */
class m161118_141132_create_users_to_polls_questions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users_to_polls_questions', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'question_poll_id' => $this->integer(),

            'email' => $this->string(),
            'message' => $this->text(),

            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users_to_polls_questions');
    }
}
