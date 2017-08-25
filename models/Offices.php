<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "offices".
 *
 * @property integer $id
 * @property double $lat
 * @property double $long
 * @property string $address_ru
 * @property string $address_ua
 * @property string $address_en
 * @property integer $is_main
 * @property integer $city_id
 * @property string $phone
 * @property string $how_we_works_ru
 * @property string $how_we_works_ua
 * @property string $how_we_works_en
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Offices extends BaseModel
{

    public $address;
    public $how_we_works;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'long', 'zoom'], 'required'],
            [['lat', 'long', 'zoom'], 'number'],
            [['is_main', 'city_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['how_we_works_ru', 'how_we_works_ua', 'how_we_works_en'], 'string'],
            [['address_ru', 'address_ua', 'address_en', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_ru' => Yii::t('app/admin', 'Адрес'),
            'address_ua' => Yii::t('app/admin', 'Адрес'),
            'address_en' => Yii::t('app/admin', 'Адрес'),
            'is_main' => Yii::t('app/admin', 'Главный офис'),
            'city_id' => Yii::t('app/admin', 'Город'),
            'phone' => Yii::t('app/admin', 'Телефоны'),
            'how_we_works_ru' => Yii::t('app/admin', 'Режим работы'),
            'how_we_works_ua' => Yii::t('app/admin', 'Режим работы'),
            'how_we_works_en' => Yii::t('app/admin', 'Режим работы'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public function afterFind()
    {
        $this->address = $this->{self::getTranslate('address')};
        $this->how_we_works = $this->{self::getTranslate('how_we_works')};
        parent::afterFind();
    }
}
