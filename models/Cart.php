<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\Cookie;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cart extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
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
            [['user_id', 'created_at', 'updated_at'], 'integer'],
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
            'created_at' => Yii::t('app/admin', 'Created At'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
        ];
    }

    public function apply() {
        if ($this->save()) {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new Cookie([
                'name' => 'cart',
                'value' => $this->id
            ]));
        }
    }

    public static function getCartId(){
        $cookies = Yii::$app->request->cookies;
        if($cookies->has('cart')){
            return $cookies['cart']->value;
        }else{
            return null;
        }
    }
    public static function isDelivery(){
        $cookies = Yii::$app->request->cookies;
        if($cookies->has('delivery')){
            return $cookies['delivery']->value;
        }else{
            return false;
        }
    }
    public static function isCutting(){
        $cookies = Yii::$app->request->cookies;
        if($cookies->has('cutting')){
            return $cookies['cutting']->value;
        }else{
            return false;
        }
    }

    public function getCart(){
        $cookies = Yii::$app->request->cookies;
        return $cookies->has('cart') ? ($this->findOne($cookies['cart']) ? $this->findOne($cookies['cart']) : $this) : $this;
    }

    public function isNewCart(){
        return (isset($this->id)&&!empty($this->id)) ? false : true;
    }

    public static function emptyCart(){

        $cartId = self::getCartId();

        self::deleteAll($cartId);
        CartProducts::deleteAll(['cart_id' => $cartId]);

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'cart',
            'value' => ''
        ]));
    }
}
