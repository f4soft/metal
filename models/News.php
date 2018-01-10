<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
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
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_ua
 * @property string $meta_keywords_en
 * @property string $meta_description_ru
 * @property string $meta_description_ua
 * @property string $meta_description_en
 * @property string $alias
 * @property integer $status
 * @property date $date_show
 * @property integer $updated_at
 * @property integer $created_at
 */
class News extends BaseModel
{
    public $title;
    public $description;
    public $image_alt;
    public $image_title;
    public $meta_description;
    public $meta_keywords;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['description_ru', 'description_ua', 'description_en'], 'string'],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['alias'], 'unique'],
            [['date_show'], 'date', 'format' => 'php:Y-m-d'],
            [['title_ru', 'title_ua', 'title_en', 'image_alt_ru', 'image_alt_ua', 'image_alt_en', 'image_title_ru',
                'image_title_ua', 'image_title_en', 'meta_keywords_ru', 'meta_keywords_ua', 'meta_keywords_en',
                'meta_description_ru', 'meta_description_ua', 'meta_description_en', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),

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

            'meta_keywords_ru' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_ua' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_en' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_description_ru' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_ua' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_en' => Yii::t('app/admin', 'Описание для метатегов'),

            'alias' => Yii::t('app/admin', 'Url'),
            'status' => Yii::t('app/admin', 'Статус'),
            'date_show' => Yii::t('app/admin', 'Дата (что отображается для пользователя)'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->description = $this->{self::getTranslate('description')};
        $this->meta_description = $this->{self::getTranslate('meta_description')};
        $this->meta_keywords = $this->{self::getTranslate('meta_keywords')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        $this->image_alt = $this->{self::getTranslate('image_alt')};

        parent::afterFind();
    }

    static public function getPressCenterNews()
    {
        $news = self::find()->getActive()->orderBy('created_at DESC')->limit(4)->all();
        return ['first' => array_shift($news), 'other' => $news];
    }

}
