<?php

namespace app\models;

use Yii;
use \app\models\BaseModel;

/**
 * This is the model class for table "seo_tags".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $description
 */
class SeoTags extends BaseModel
{
    public function behaviors()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'title', 'description'], 'string', 'max' => 255],
            ['url', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'title' => 'Meta title',
            'description' => 'Meta description',
        ];
    }

    public static function getMetaTags($url)
    {
        return self::find()->where(['url'=>$url])->one();
    }
}
