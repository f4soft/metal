<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $external_id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $sku
 * @property integer $count
 * @property integer $category_id
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
 * @property string $article_title_ru
 * @property string $article_title_ua
 * @property string $article_title_en
 * @property string $unit
 * @property double $diameter
 * @property double $length
 * @property double $width
 * @property double $height
 * @property double $depth
 * @property string $aisi
 * @property double $cut_price
 * @property string $image
 * @property string $image_alt_ru
 * @property string $image_alt_ua
 * @property boolean $popular

 * @property string $article_description_ru
 * @property string $article_description_ua
 * @property string $article_description_en
 * @property string $alias
 * @property integer $status
 * @property tinyint $stock "set as special offers (or not)"
 * @property integer $updated_at
 * @property integer $created_at
 */
class Products extends BaseModel
{
    public $title;
    public $image_alt;
    public $image_title;
    public $meta_keywords;
    public $meta_description;
    public $article_title;
    public $article_description;
    public $city_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'stock', 'status', 'popular', 'updated_at', 'created_at'], 'integer'],
            [['category_id'], 'required'],
            [['diameter', 'length', 'width', 'height', 'depth', 'cut_price'], 'number'],
            [['article_description_ru', 'article_description_ua', 'article_description_en'], 'string'],
            [['external_id', 'title_ru', 'title_ua', 'title_en', 'sku', 'unit', 'aisi', 'image', 'image_alt_ru',
                'image_alt_ua', 'image_alt_en', 'image_title_ru', 'image_title_ua', 'image_title_en', 'meta_keywords_ru',
                'meta_keywords_ua', 'meta_keywords_en', 'meta_description_ru', 'meta_description_ua',
                'meta_description_en', 'article_title_ru', 'article_title_ua', 'article_title_en',
                'alias', 'unit_key'], 'string', 'max' => 255],
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
            'sku' => Yii::t('app/admin', 'Складской номер'),
            'count' => Yii::t('app/admin', 'Колличество'),
            'category_id' =>  Yii::t('app/admin', 'Категория'),

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

            'article_title_ru' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_title_ua' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_title_en' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_description_ru' => Yii::t('app/admin', 'СЕО описание'),
            'article_description_ua' => Yii::t('app/admin', 'СЕО описание'),
            'article_description_en' => Yii::t('app/admin', 'СЕО описание'),

            'external_id' => Yii::t('app/admin', 'External ID'),
            'unit' => Yii::t('app/admin', 'Unit'),
            'diameter' => Yii::t('app/admin', 'Diameter'),
            'length' => Yii::t('app/admin', 'Length'),
            'width' => Yii::t('app/admin', 'Width'),
            'height' => Yii::t('app/admin', 'Height'),
            'depth' => Yii::t('app/admin', 'Depth'),
            'aisi' => Yii::t('app/admin', 'Aisi'),
            'coefficient' => Yii::t('app/admin', 'Coefficient'),
            'cut_price' => Yii::t('app/admin', 'Cut Price'),

            'description_ru' => Yii::t('app/admin', 'Описание'),
            'description_ua' => Yii::t('app/admin', 'Описание'),
            'description_en' => Yii::t('app/admin', 'Описание'),

            'alias' => Yii::t('app/admin', 'Alias'),
            'status' => Yii::t('app/admin', 'Статус'),
            'stock' => Yii::t('app/admin', 'Акция'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
            'popular' => Yii::t('app/admin', 'Популярный товар'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->image_alt = $this->{self::getTranslate('image_alt')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        $this->meta_keywords = $this->{self::getTranslate('meta_keywords')};
        $this->meta_description = $this->{self::getTranslate('meta_description')};
        $this->article_title = $this->{self::getTranslate('article_title')};
        $this->article_description = $this->{self::getTranslate('article_description')};
        if (empty($this->unit) || empty($this->unit_key)) {
            $this->unit_key = 'sht';
            $this->unit = 'шт';
        }
        parent::afterFind();
    }

    public static function getPopular($catID = false)
    {
//        if(!$catID)
//            return self::find()->getActive()->where(['popular' => 1])->orderBy('id ASC')->limit(10)->all();
//        return self::find()->getActive()->where(['popular' => 1, 'category_id' => $catID])->limit(10)->orderBy('id ASC')->all();
        return self::find()->getActive()->where(['popular' => 1])->orderBy('id ASC')->limit(10)->all();
    }

    /**
     * Get category url
     * @param Products $item
     * @return bool|string
     */
    public static function getUrl(Products $item)
    {
        if($item instanceof Products){
            $parent = ProductsCategories::getRootCategory($item->category_id);
            $category = ProductsCategories::findOne(['id' => $item->category_id]);
            return "catalog/{$parent->alias}/{$category->alias}/{$item->alias}";
        }
        return false;
    }

}
