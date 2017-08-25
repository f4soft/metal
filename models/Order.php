<?php

namespace app\models;

use app\models\Cart;
use app\models\CartProducts;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\Cookie;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $sum
 * @property double $weight
 * @property integer $status
 * @property integer $delivery
 * @property integer $cutting
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends BaseModel
{
//    public $cart;
//    public $cartProducts;
//
//    public function __construct($orderId = null)
//    {
//        if (is_null($orderId)) {
//            $this->user_id = \Yii::$app->user->identity->getId();
//            $this->save();
//        } else {
//            return self::find()->where(['id' => $orderId]);
//        }
//        parent::__construct();
//    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
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
            [['user_id','status','delivery','cutting', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'user_id' => Yii::t('app/admin', 'User ID'),
            'sum' => Yii::t('app/admin', 'Sum'),
            'weight' => Yii::t('app/admin', 'Weight'),
            'status' => Yii::t('app/admin', 'Status'),
            'delivery' => Yii::t('app/admin', 'Delivery'),
            'cutting' => Yii::t('app/admin', 'Cutting'),
            'created_at' => Yii::t('app/admin', 'Created At'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
        ];
    }

    function initOrder()
    {
        $this->user_id = \Yii::$app->user->identity->getId();
        $this->save();
    }

    public function saveFromCart()
    {
        $this->initOrder();
        $orderProducts = $this->getFromCart();
        $this->sum = 0;
        $this->weight = 0;
        foreach ($orderProducts as $product) {
            $this->saveProduct($product);
            $this->sum += $product->price;
            $this->weight += (double)$product->weight;
        }
        if (Cart::isDelivery()) {
            $this->delivery = 1;
        } else {
            $this->delivery = 0;
        }
        if (Cart::isCutting()) {
            $this->cutting = 1;
        } else {
            $this->cutting = 0;
        }
        $this->save();
        Cart::emptyCart();
    }

    public function getFromCart()
    {
        return CartProducts::getCartProducts();
    }
    public function saveProduct($product)
    {
        $orderProduct = new OrderProducts($this->id);
        $orderProduct->price = $product->price;
        $orderProduct->product_id = $product->product_id;
        $orderProduct->unit = $product->unit;
        $orderProduct->unit_value = $product->unit_value;
        $orderProduct->count = $product->count;
        $orderProduct->cut = !empty($product->cut) ? $product->cut : 0;
        $orderProduct->delivery = !empty($product->delivery) ? $product->delivery : 0;
        $orderProduct->save();
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ["id" => "user_id"]);
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['order_id' => 'id']);
    }

}
