<?php

use yii\db\Migration;

class m170322_134012_seed_khmelnytskyi_chernigov_to_bd extends Migration
{
    public function up()
    {
       /* $this->insert('cities', [
            'title_ru' => 'Хмельницкий',
            'title_ua' => 'Хмельницький',
            'title_en' => 'Khmelnytskyi',
            'external_id' => '000000009',
            'status' => '1',
            'alias' => 'khmelnytskyi',
            'is_default' => '0',
            'updated_at' => time(),
            'created_at' => time(),
        ]);
        $this->insert('cities', [
            'title_ru' => 'Чернигов',
            'title_ua' => 'Чернігів',
            'title_en' => 'Chernihiv',
            'external_id' => '000000010',
            'status' => '1',
            'alias' => 'chernihiv',
            'is_default' => '0',
            'updated_at' => time(),
            'created_at' => time(),
        ]);
        $this->insert('offices', [
            'lat' => '49.409365',
            'long' => '27.020427',
            'zoom' => '14',
            'address_ru' => 'ул.Черновола, 88',
            'address_ua' => 'вул.Чорновола, 88',
            'address_en' => 'Chernovola str., 88',
            'is_main' => '1',
            'city_id' => '8',
            'phone' => '0382 644-177 0382 644-122',
            'how_we_works_ru' => '<p>с 8:30 до 17:30 без перерыва&nbsp;</p><p>Эл. почта:&nbsp;<a href="mailto:hm_mht@metal.kiev.ua ">hm_mht@metal.kiev.ua </a></p>',
            'how_we_works_ua' => '<p>Графік роботи: </p><p>від 8-30 до 17-30 без перерви<br /></p>',
            'how_we_works_en' => '<p>Графік роботи: </p><p>від 8-30 до 17-30 без перерви<br /></p>',
            'status' => '1',
            'updated_at' => time(),
            'created_at' => time(),
        ]);
        $this->insert('offices', [
            'lat' => '51.498909',
            'long' => '31.289485',
            'zoom' => '14',
            'address_ru' => 'Myru Ave, 49',
            'address_ua' => 'Myru Ave, 49',
            'address_en' => 'Myru Ave, 49',
            'is_main' => '1',
            'city_id' => '9',
            'phone' => '0382 111 11 11',
            'how_we_works_ru' => '<p>с 8:30 до 17:30 без перерыва&nbsp;</p><p>Эл. почта:&nbsp;<a href="mailto:hm_mht@metal.kiev.ua ">hm_mht@metal.kiev.ua </a></p>',
            'how_we_works_ua' => '<p>Графік роботи: </p><p>від 8-30 до 17-30 без перерви<br /></p>',
            'how_we_works_en' => '<p>Графік роботи: </p><p>від 8-30 до 17-30 без перерви<br /></p>',
            'status' => '1',
            'updated_at' => time(),
            'created_at' => time(),
        ]);*/
    }

    public function down()
    {
        echo "m170322_134012_seed_khmelnytskyi_chernigov_to_bd reverted.\n";

        return true;
    }
}
