<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $cat_description_ru
 * @property string $cat_description_ru
 * @property string $cat_description_ru  
 * @property string $sub_cat_description_ru
 * @property string $sub_cat_description_ru
 * @property string $sub_cat_description_ru  
 * @property string $product_description_ru
 * @property string $product_description_ru
 * @property string $product_description_ru 
 * @property string $alias
 * @property string $external_id
 * @property integer $status
 * @property integer $is_default
 * @property integer $updated_at
 * @property integer $created_at
 */
class Cities extends BaseModel
{
    public $title;
    public $cat_description;
    public $sub_cat_description;
    public $product_description;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'updated_at', 'created_at', 'is_default'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'alias', 'external_id'], 'string', 'max' => 255],
            [['cat_description_ru', 'cat_description_ua', 'cat_description_en',
              'sub_cat_description_ru', 'sub_cat_description_ua', 'sub_cat_description_en', 
              'product_description_ru', 'product_description_ua', 'product_description_en'], 'string'],
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
            'cat_description_ru' => Yii::t('app/admin', 'Описание Категории'),
            'cat_description_ua' => Yii::t('app/admin', 'Описание Категории'),
            'cat_description_en' => Yii::t('app/admin', 'Описание Категории'),
            'sub_cat_description_ru' => Yii::t('app/admin', 'Описание Подкатегории'),
            'sub_cat_description_ua' => Yii::t('app/admin', 'Описание Подкатегории'),
            'sub_cat_description_en' => Yii::t('app/admin', 'Описание Подкатегории'),
            'product_description_ru' => Yii::t('app/admin', 'Описание Продукта'),
            'product_description_ua' => Yii::t('app/admin', 'Описание Продукта'),
            'product_description_en' => Yii::t('app/admin', 'Описание Продукта'),
            'status' => Yii::t('app/admin', 'Статус'),
            'is_default' => Yii::t('app/admin', 'Город по умолчанию'),
            'updated_at' => Yii::t('app/admin', 'Обновлен'),
            'created_at' => Yii::t('app/admin', 'Создан'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->cat_description = $this->{self::getTranslate('cat_description')};
        $this->sub_cat_description = $this->{self::getTranslate('sub_cat_description')};
        $this->product_description = $this->{self::getTranslate('product_description')};
        parent::afterFind();
    }

    static public function getByAlias($alias)
    {        
        return self::findOne(['alias' => $alias]);
    }
    
    static public function getByAliasOrKiev($alias)
    {        
        $alias = $alias ? $alias : "kiev";
        
        return self::findOne(['alias' => $alias]);
    }

    static public function getDefaultCity()
    {
        return self::findOne(['is_default' => 1,'status'=>1]);
    }
}
