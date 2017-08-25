<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property string $title
 * @property string $description_ru
 * @property string $description_ua
 * @property string $description_en
 * @property string $image
 * @property string $image_alt_ru
 * @property string $image_alt_ua
 * @property string $image_alt_en
 * @property string $image_title_ru
 * @property string $image_title_ua
 * @property string $image_title_en
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class History extends BaseModel
{
    public $image_alt;
    public $image_title;
    public $description;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
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
            [['title'], 'required'],
            [['status', 'updated_at', 'created_at', 'title'], 'integer'],
            [['title'], 'string', 'max' => 4],
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['image', 'image_alt_ru', 'image_alt_ua', 'image_alt_en', 'image_title_ru',
                'image_title_ua', 'image_title_en'], 'string', 'max' => 255],
            [['description_ru', 'description_ua', 'description_en'], 'string', 'max' => 270],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app/admin', 'Заголовок'),
            'description_ru' => Yii::t('app/admin', 'Описание'),
            'description_ua' => Yii::t('app/admin', 'Описание'),
            'description_en' => Yii::t('app/admin', 'Описание'),

            'image' => Yii::t('app/admin', 'Фото'),
            'image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_title_en' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ru' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ua' => Yii::t('app/admin', 'Заголовок для фото'),

            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public function afterFind()
    {
        $this->image_alt = $this->{self::getTranslate('image_alt')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        $this->description = $this->{self::getTranslate('description')};
        parent::afterFind();
    }
}
