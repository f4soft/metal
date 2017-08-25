<?php

namespace app\modules\offices\controllers;

use Yii;
use app\components\AppController;
use app\models\Feedback;
use app\models\Forms\OfficesContactForm;
use yii\web\Response;

class SendController extends AppController
{
    public function actionIndex()
    {
        $modelStore = new Feedback();
        $model = new OfficesContactForm();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if($post) {
            $modelStore->attributes = Yii::$app->request->post('OfficesContactForm');
            $modelStore->email =  Yii::$app->request->post('OfficesContactForm')['email_from'];
            if($modelStore->validate() && $modelStore->save()) {
                $model->sendEmail(Yii::$app->params['adminEmail'], Yii::$app->request->post('OfficesContactForm')['email_to'], Yii::t('app', 'Обратная связь'),
                    $this->renderPartial('@app/views/emails/email_feedback',
                    [
                        'model' => $modelStore,
                    ]
                ));
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }

        return ['success' => false];

    }
}