<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_ua
 * @property string $description_en
 * @property string $big_image
 * @property string $small_image
 * @property string $small_image_alt_ru
 * @property string $small_image_alt_ua
 * @property string $small_image_alt_en
 * @property string $small_image_title_ru
 * @property string $small_image_title_ua
 * @property string $small_image_title_en
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Services extends BaseModel
{
    public $title;
    public $description;
    public $small_image_alt;
    public $small_image_title;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['small_image', 'big_image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['description_ru', 'description_ua', 'description_en'], 'string'],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'small_image_alt_ru', 'small_image_alt_ua', 'small_image_alt_en', 'small_image_title_ru', 'small_image_title_ua', 'small_image_title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),

            'description_ru' => Yii::t('app/admin', 'Описание'),
            'description_ua' => Yii::t('app/admin', 'Описание'),
            'description_en' => Yii::t('app/admin', 'Описание'),

            'small_image' => Yii::t('app/admin', 'Иконка услуги'),
            'big_image' => Yii::t('app/admin', 'Фото'),

            'small_image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для иконки услуги'),
            'small_image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для иконки услуги'),
            'small_image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для иконки услуги'),
            'small_image_title_ru' => Yii::t('app/admin', 'Заголовок для иконки услуги'),
            'small_image_title_ua' => Yii::t('app/admin', 'Заголовок для иконки услуги'),
            'small_image_title_en' => Yii::t('app/admin', 'Заголовок для иконки услуги'),

            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->description = $this->{self::getTranslate('description')};
        $this->small_image_title = $this->{self::getTranslate('small_image_title')};
        $this->small_image_alt = $this->{self::getTranslate('small_image_alt')};

        parent::afterFind();
    }

    static public function isMaxServices()
    {
        $services = self::find()->all();
        if(count($services) > 4 ) {
            return false;
        }
        return true;
    }
}
