<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "products_prices_to_cities".
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $product_id
 * @property double $price
 * @property integer $updated_at
 * @property integer $created_at
 */
class ProductsPricesToCities extends BaseModel
{
    public $description;

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
        return 'products_prices_to_cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'product_id', 'updated_at', 'created_at'], 'integer'],
            [['price', 'coefficient'], 'number'],
            [['description_ru', 'description_ua', 'description_en'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'price' => Yii::t('app/admin', 'Цена'),
            'description_ru' => Yii::t('app/admin', 'Описание Ru'),
            'description_ua' => Yii::t('app/admin', 'Описание Ua'),
            'description_en' => Yii::t('app/admin', 'Описание En'),
            'coefficient' => Yii::t('app/admin', 'Coefficient'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }

    public function afterFind()
    {
        $this->description = $this->{self::getTranslate('description')};
        parent::afterFind();
    }
}
