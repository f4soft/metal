<?php

use yii\db\Migration;

class m161214_114908_updating_user_table_add_is_admin extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'is_admin', $this->boolean()->defaultValue(0));
    }

    public function down()
    {
        echo "m161214_114908_updating_user_table_add_is_admin cannot be reverted.\n";

        return false;
    }
}
