<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cart_products".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $user_id
 * @property integer $product_id
 * @property double $price
 * @property string $unit
 * @property double $unit_value
 * @property double $weight
 * @property string $count
 * @property integer $created_at
 * @property integer $updated_at
 */
class CartProducts extends BaseModel
{
    public $cart;

    public function __construct($cart = null){
        if($cart){
            $this->cart = $cart;
            $this->cart_id = !empty($cart->id) ? $cart->id : null;
        }
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_products';
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
            [['cart_id', 'user_id', 'product_id', 'created_at', 'updated_at', 'count'], 'integer'],
            [['price', 'unit_value', 'weight'], 'number'],
            [['created_at', 'updated_at'], 'required'],
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
            'cart_id' => Yii::t('app/admin', 'Cart ID'),
            'user_id' => Yii::t('app/admin', 'User ID'),
            'product_id' => Yii::t('app/admin', 'Product ID'),
            'price' => Yii::t('app/admin', 'Price'),
            'unit' => Yii::t('app/admin', 'Unit'),
            'unit_value' => Yii::t('app/admin', 'Unit Value'),
            'weight' => Yii::t('app/admin', 'Weight'),
            'count' => Yii::t('app/admin', 'Count'),
            'created_at' => Yii::t('app/admin', 'Created At'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
        ];
    }


    public static function getCartProducts($cartId = null, $asArray = false)
    {
        if(is_null($cartId)) {
            $cartId = Cart::getCartId();
        }

        if($asArray) {
            return array_column(self::find()->select('id')->where(['cart_id' => $cartId])->asArray()->all(), 'id');
        }

        return self::find()->with('product')->where(['cart_id' => $cartId])->all();
    }

    static public function getCartCounter($cartId = null)
    {
        $total = 0;

        if(is_null($cartId) && is_null($cartId = Cart::getCartId())){
            return $total;
        }

        return self::find()->where(['cart_id' => $cartId])->count();
    }

    static public function getTotal($cartId = null){
        $total = 0;

        if(is_null($cartId) && is_null($cartId = Cart::getCartId())){
            return ['total' => $total];
        }

        foreach(CartProducts::getCartProducts($cartId) as $singleCartItem){
            $total += $singleCartItem->price;
        }

        return $total;
    }

    static public function getTotalWeight($cartId = null){
        $total = 0;

        if(is_null($cartId) && is_null($cartId = Cart::getCartId())){
            return $total;
        }

        foreach(CartProducts::getCartProducts($cartId) as $singleCartItem){
            $total += (double)$singleCartItem->weight;
        }

        return $total;
    }

    public function addCartItem(){
        $this->cart_id = $this->cart->id;
        if($this->save(false)){
            return $this->price;
        }
        return 0;
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
