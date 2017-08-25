<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order_products".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property double $price
 * @property string $unit
 * @property double $unit_value
 * @property string $count
 * @property integer $cut
 * @property integer $delivery
 */
class OrderProducts extends BaseModel
{
    public $orderId;

    public function __construct($order = null)
    {
        if ($order) {
            $this->orderId = $this->order_id = $order;
        }
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_products';
    }

    public function behaviors()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'count', 'delivery', 'cut', 'delivery'], 'integer'],
            [['price', 'unit_value'], 'number'],
            [['unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'order_id' => Yii::t('app/admin', 'User ID'),
            'product_id' => Yii::t('app/admin', 'Product ID'),
            'price' => Yii::t('app/admin', 'Price'),
            'unit' => Yii::t('app/admin', 'Unit'),
            'unit_value' => Yii::t('app/admin', 'Unit Value'),
            'count' => Yii::t('app/admin', 'Count'),
            'cut' => Yii::t('app/admin', 'Cut'),
            'delivery' => Yii::t('app/admin', 'Delivery'),
        ];
    }


    public function getOrderProducts($asArray = false)
    {
        if($asArray) {
            return array_column(self::find()->select('id')->where(['order_id' => $this->order_id])->asArray()->all(), 'id');
        }

        return self::find()->where(['order_id' => $$this->order_id])->all();
    }

    public function getOrderCounter()
    {
        return self::find()->where(['order_id' => $this->order_id])->count();
    }

    public function getProductTitle()
    {
        return $this->hasOne(Products::className(), ["id" => "product_id"])->one()->title_ru;
    }
}
