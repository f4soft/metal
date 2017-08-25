<?php
namespace app\controllers;


use app\models\Forms\NewsSubscribeForm;
use kartik\helpers\Html;
use Yii;
use app\components\AppController;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\NewsToken;
use app\models\NewsSubcribers;

class SubscribeController extends AppController
{
    public function actionNews()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $errorMessage = '';

        $modelSubscribers = new NewsSubcribers();
        $modelSubscribersToken = new NewsToken();
        $model = new NewsSubscribeForm();
        if($post) {
            $modelSubscribers->email = $post['NewsSubscribeForm']['email'];
            $modelSubscribers->language = $post['NewsSubscribeForm']['language'];
            if($modelSubscribers->validate() && $modelSubscribers->save()) {
                $modelSubscribersToken->news_subscriber_id = $modelSubscribers->id;
                $modelSubscribersToken->code = Yii::$app->security->generateRandomString();
                if($modelSubscribersToken->save()){
                    $link = Yii::$app->request->hostInfo . '/subscribe/confirm?code=' . $modelSubscribersToken->code.'&id=' . $modelSubscribers->id;
                    $model->sendEmail(Yii::$app->params['adminEmail'], $modelSubscribers->email, Yii::t('app', 'Подтвердите рассылку на') . " ". Yii::$app->request->hostName, $this->renderPartial('@app/views/emails/email_confirm',
                        [
                            'message_action_type' => Yii::t('app', 'Пожалуйста, подтвердите подписку на сайте'),
                            'link' => $link,
                        ]
                    ));
                    return ['success' => true];
                }
            }
            if(!empty($modelSubscribers->errors['email'])) {
                $errorMessage = $modelSubscribers->errors['email'][0];
            }

            return ['success' => false, 'errorMessage' => $errorMessage];
        }
        return ['success' => false];
    }

    public function actionUnsubscribe($code, $id)
    {
        if(!$code){
            throw new NotFoundHttpException();
        }
        if(NewsSubcribers::userSubscribed($code, $id)){
            if(NewsSubcribers::unsubscribe($id)){
                $message = Yii::t('app', 'Подписка на рассылку успешно отключена');
            } else {
                $message = Yii::t('app', 'Код подтверждения подписки неверный');
            }
        } else {
            $message = Yii::t('app', 'Код подтверждения подписки неверный');
        }
        return $this->render('unsubscribe', ['message' => $message]);
    }

    public function actionConfirm($code, $id)
    {
        if(!$code){
            throw new NotFoundHttpException();
        }
        if(NewsToken::validateCode($code, $id)){
            $message = Yii::t('app', 'Подписка на рассылку успешно подтверждена');
        } else {
            $message = Yii::t('app', 'Код подтверждения подписки неверный');
        }
        return $this->render('@app/views/emails/confirm', ['message' => $message]);
    }
}
