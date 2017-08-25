<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161110_141430_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),

            'email' => $this->string()->notNull()->unique(),
            'name' => $this->string(),
            'city' => $this->string(),
            'phone' => $this->string(),
            'message' => $this->text(),
            'company' => $this->string(),
            'okpo' => $this->string(),
            'inn' => $this->string(),

            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
