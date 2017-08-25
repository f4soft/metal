<?php

use yii\db\Migration;

class m161216_115252_seed_user_table_with_admin extends Migration
{
    public function up()
    {
        $this->insert('user', [
            'email' => 'admin@example.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
//            'auth_key' => Yii::$app->security->generateRandomString(),
            'is_admin' =>1,
            'status' =>10
        ]);
    }

    public function down()
    {
        echo "m161216_115252_seed_user_table_with_admin cannot be reverted.\n";

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
