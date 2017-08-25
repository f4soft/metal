<?php

use yii\db\Migration;

/**
 * Handles the creation for table `settings`.
 */
class m161007_083902_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "value" => $this->string()->notNull(),
            "const_name" => $this->string()->notNull(),
        ]);

        $this->insert(
            'settings',
            [
                'name' => 'GOOGLE maps key',
                'value' => 'AIzaSyBMqjgyRut9mdtyOmC8OP8JimpO6hOg4-o',
                'const_name' => 'GOOGLE_MAPS_KEY'
            ]
        );

        $this->insert(
            'settings',
            [
                'name' => 'E-mail для рассылки вакансий',
                'value' => 'test@test.com',
                'const_name' => 'VACANCIES_MAIL'
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('settings');
    }
}
