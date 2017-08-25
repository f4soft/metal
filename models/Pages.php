<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_ua
 * @property string $description_en
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_ua
 * @property string $meta_keywords_en
 * @property string $meta_description_ru
 * @property string $meta_description_ua
 * @property string $meta_description_en
 * @property string $alias
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Pages extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_ru', 'description_ua', 'description_en'], 'string'],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'meta_keywords_ru', 'meta_keywords_ua', 'meta_keywords_en', 'meta_description_ru', 'meta_description_ua', 'meta_description_en', 'alias'], 'string', 'max' => 255],
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

            'meta_keywords_ru' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_ua' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_en' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_description_ru' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_ua' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_en' => Yii::t('app/admin', 'Описание для метатегов'),

            'alias' => Yii::t('app/admin', 'Url'),
            'status' => Yii::t('app/admin', 'Статус'),
        ];
    }
}
