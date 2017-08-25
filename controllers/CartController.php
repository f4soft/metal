<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/5/16
 * Time: 12:51 PM
 */

namespace app\controllers;

use app\models\Cart;
use app\models\CartProducts;
use app\models\Cities;
use Yii;
use app\components\AppController;
use app\components\Helper;
use app\models\Products;
use yii\web\Response;
use yii\web\Cookie;

class CartController extends AppController
{
    public function actionAddToCart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $modelCart = (new Cart())->getCart();
        $post = Yii::$app->request->post();

        $productValid = Products::findOne(['id' => $post['CartProducts']['product_id']]);

        if (!$productValid) {
            throw new \yii\web\NotFoundHttpException;
        }

        if ($modelCart->isNewCart()) {
            $modelCart->apply();
            $count = 1;
        }

        $modelCartItems = (new CartProducts($modelCart));

        if ($modelCartItems->load($post)) {

            $modelCartItems->addCartItem();
            if (empty($count)) {
                $count = CartProducts::getCartCounter();
            }
            return ['success' => true, 'count' => $count, 'word'=> Helper::getWord($count, [
                Yii::t('app', 'товар'), Yii::t('app', 'товара'), Yii::t('app', 'товаров')]) ];
        }
        return ['success' => false];
    }

    public function actionGetCartHtml()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $products = \app\models\CartProducts::getCartProducts();
        $city = $this->selectedCity;
        if (!$city) {
            $city = 'kiev';
        }
        $city = Cities::findOne(['alias' => $city]);
        $html = $this->renderPartial('@app/views/products/cart',
            ['city' => $city, 'products' => $products, 'total' => \app\models\CartProducts::getTotal()]);

        return ['success' => true, 'html' => $html];
    }

    public function actionDeleteFromCart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        $productValid = CartProducts::findOne(['id' => $post['delete_id']]);

        if (!$productValid) {
            throw new \yii\web\NotFoundHttpException;
        }
        $productValid->delete();

        $count = \app\models\CartProducts::getCartCounter();
        if ($count > 0) {
            $products = \app\models\CartProducts::getCartProducts();
            $total = \app\models\CartProducts::getTotal();
        } else {
            $products = array();
            $total = 0;
        }
        $city = $this->selectedCity;
        if (!$city) {
            $city = 'kiev';
        }
        $city = Cities::findOne(['alias' => $city]);
        $html = $this->renderPartial('@app/views/products/cart',
            ['city' => $city, 'products' => $products, 'total' => $total]);

        return ['success' => true, 'html' => $html, 'count' => $count];
    }

    public function actionUpdateCart()
    {
        $post = Yii::$app->request->post();

        $productValid = CartProducts::findOne(['id' => $post['id']]);

        if (!$productValid) {
            throw new \yii\web\NotFoundHttpException;
        }

        $productValid->count = $post['count'];
        $productValid->unit = $post['unit'];
        $productValid->price = $post['price'];
        if ($post['weight'] && is_numeric($post['weight'])){
            $productValid->weight = $post['weight'];
        }
        $productValid->save(false);
    }

    public function actionUpdateCartOptions()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cookies = Yii::$app->response->cookies;
        $post = Yii::$app->request->post();
        switch ($post['name']) {
            case 'delivery-cart-popup':
                $name = 'delivery';
                break;
            case 'delivery-cart':
                $name = 'delivery';
                break;
            case 'cutting-cart-popup':
                $name = 'cutting';
                break;
            case 'cutting-cart':
                $name = 'cutting';
                break;
        }
        if (!empty($name)) {
            $cookies->add(new Cookie([
                'name' => $name,
                'value' => $post['check'] == 'true' ? true:false
            ]));
            return ['success' => true];
        }
        return ['success' => false];
    }
}