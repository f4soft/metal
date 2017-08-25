<?php

use yii\db\Migration;

class m170228_094144_seed_user_table_with_admin2 extends Migration
{
    public function up()
    {
//        $this->insert('user', [
//            'email' => 'metall.holding.mht@gmail.com',
//            'auth_key' => Yii::$app->security->generateRandomString(),
//        ]);
        $this->update('user', [
            'password_hash' => Yii::$app->security->generatePasswordHash('metalholding22091992stainlessaluminiumferroussteel'),
            'is_admin' => 1,
            'status' => 10
        ], ['email'=>'metall.holding.mht@gmail.com']);
    }

    public function down()
    {
        echo "m170228_094144_seed_user_table_with_admin2 cannot be reverted.\n";

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
