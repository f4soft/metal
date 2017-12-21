<?php
namespace app\controllers;

use app\components\AppController;
use app\models\CartProducts;
use app\models\Forms\SignupForm;
use app\models\Forms\LoginForm;
use app\models\Order;
use app\models\NewsToken;
use app\models\NewsSubcribers;
use app\models\User;
use Yii;
use yii\web\Response;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class CheckoutController extends AppController
{
    /**
     * Index page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cartCount = CartProducts::getCartCounter();
        if ($cartCount == 0) {
            $this->goBack();
        }
        $products = CartProducts::getCartProducts();
        return $this->render('index', [
            'data' => [
                'count' => $cartCount,
                'total-money' =>CartProducts::getTotal(),
                'total-weight' => round(CartProducts::getTotalWeight() * 1000,2),
                'products' => $products,
            ]
        ]);
    }

    /**
     * Order action.
     *
     * @return string
     */
    public function actionOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
 
        if ($post['user'] == 'old') { // old user - need validate and log in
            $model = new LoginForm();
            if ($model->load($post, '')) {//form validation and user login
                if (!$model->login()) {
                    return ['success' => false, 'errors' => $model->errors];
                }
                $user = Yii::$app->user->identity;
            }
        }
        if ($post['user'] == 'new') { // new user
            $model = new SignupForm();
            if ($model->load($post, '')) {
                if ($user = $model->signup()) { //form validation and user login
                    Yii::$app->getUser()->login($user, 3600 * 24 * 30);
                    /*Отправить юзеру письмо с логином и паролем*/
                    $model->sendEmail( Yii::$app->params['adminEmail'], $model->email,
                        Yii::t('app', 'Регистрация на сайте') . " " . Yii::$app->request->hostName,
                        $this->renderPartial('@app/views/emails/confirm_login',
                            [
                                'model' => $model,
                                'message_action_type' => Yii::t('app', 'Спасибо за регистрацию на сайте')
                            ]
                        ));
                } else { //form not valid
                    return ['success' => false, 'errors' => $model->errors];
                }
            }
        }
        $order_email = Yii::$app->settingsConfig->settings['orders_mail'];
        $order = new Order();
        $order->saveFromCart(); //Сохранение заказа очистка корзины
        $order -> sendEmail($order_email, $user->email,
            Yii::t('app', 'Оформление заказа на сайте') . " " . Yii::$app->request->hostName,
            $this->renderPartial('@app/views/emails/email-order-confirm-m', [
                'products' => $order->getOrderProducts()->all(),
                'order' => $order
            ]));
        $order -> sendEmail($order_email, $order_email,
            Yii::t('app', 'Новый заказ на сайте') . " " . Yii::$app->request->hostName,
            $this->renderPartial('@app/views/emails/email-order-confirm-m',[
                'products' => $order->getOrderProducts()->all(),
                'order' => $order,
                'user' => $user,
                'mes' => empty($model->message)?'': $model->message
            ]));
        /*
         * Подписка на рассылку
         */
        if (!empty($post['subscribe']) && $post['subscribe'] == 'on') {
            $modelSubscribers = new NewsSubcribers();
            $modelSubscribersToken = new NewsToken();
            $modelSubscribers->email = $model->email;
            $modelSubscribers->language = Yii::$app->params['langs'][Yii::$app->language];
            if ($modelSubscribers->validate() && $modelSubscribers->save()) {
                $modelSubscribersToken->news_subscriber_id = $modelSubscribers->id;
                $modelSubscribersToken->code = Yii::$app->security->generateRandomString();
                if ($modelSubscribersToken->save()) {
                    $link = Yii::$app->request->hostInfo . '/subscribe/confirm?code=' . $modelSubscribersToken->code .
                        '&id=' . $modelSubscribers->id;
                    $model->sendEmail(Yii::$app->params['adminEmail'], $modelSubscribers->email, Yii::t('app', 'Подтвердите рассылку на') . " " . Yii::$app->request->hostName, $this->renderPartial('@app/views/emails/email_confirm',
                        [
                            'message_action_type' => Yii::t('app', 'Пожалуйста, подтвердите подписку на сайте'),
                            'link' => $link,
                        ]
                    ));
                }
            }
        }
        return ['success' => true]; //на фронте показать попап и перенаправить на главную
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Reset password action.
     *
     * @return string
     */
    public function actionReset()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (!empty($post['email'])) {
            $user = User::findByEmail($post['email']);
            if ($user && $user->email) {
                $pass = $user->generatePassword();
                $user->sendEmail(Yii::$app->params['adminEmail'], $user->email,
                    Yii::t('app', 'Напоминание пароля на сайте') . " " . Yii::$app->request->hostName,
                    Yii::t('app', 'Ваш пароль:') . " " . $pass);
                return ['success' => true];
            }
        }
        return ['success' => false, 'error'=> Yii::t('app', 'емаил адрес не найден')];
    }
}