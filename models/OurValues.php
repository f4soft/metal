<?php

namespace app\models;

use Faker\Provider\Base;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "our_values".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
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
class OurValues extends BaseModel
{
    public $title;
    public $description;
    public $image_alt;
    public $image_title;

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
        return 'our_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' =>  'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['title_ru', 'description_ru', 'image_title_ru', 'image_alt_ru'], 'required'],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'image_alt_ru', 'image_alt_ua', 'image_alt_en',
                'image_title_ru', 'image_title_ua', 'image_title_en', 'description_ru', 'description_en',
                'description_ua'], 'string', 'max' => 255],
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

            'image' => Yii::t('app/admin', 'Иконка'),
            'image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_title_en' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ru' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ua' => Yii::t('app/admin', 'Заголовок для фото'),

            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->description = $this->{self::getTranslate('description')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        $this->image_alt = $this->{self::getTranslate('image_alt')};

        parent::afterFind();
    }
}
