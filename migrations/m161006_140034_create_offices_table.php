<?php

use yii\db\Migration;

/**
 * Handles the creation for table `offices`.
 */
class m161006_140034_create_offices_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%offices}}', [
            'id' => $this->primaryKey(),
            'lat' => $this->float()->notNull(),
            'long' => $this->float()->notNull(),
            'zoom' => $this->integer()->notNull(),

            'address_ru' => $this->string(),
            'address_ua' => $this->string(),
            'address_en' => $this->string(),

            'is_main' => $this->boolean(),
            'city_id' => $this->integer(),
            'phone' => $this->string(),
            'how_we_works_ru' => $this->text(),
            'how_we_works_ua' => $this->text(),
            'how_we_works_en' => $this->text(),

            'status' => $this->boolean(),
            'updated_at' => $this->integer(11),
            'created_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-offices-city_id',
            'offices',
            'city_id'
        );
    }



    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('offices');
    }
}
