<?php

namespace app\controllers;

use app\components\AppController;
use app\models\Settings;
use app\models\Articles;
use app\models\BlockSettings;
use app\models\Callback;
use app\models\Cities;
use app\models\Feedback;
use app\models\Forms\NewsSubscribeForm;
use app\models\News;
use app\models\Services;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionError()
    {
        return $this->render('error', ['selectedCity' => $this->selectedCity]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*'error' => [
                'class' => 'yii\web\ErrorAction',
            ],*/
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cities = Cities::find()->getActive()->with('officesByCity')->all();
        $services = Services::getAll();
        $modelContact = new \app\models\Forms\ContactForm;
        $articles = Articles::getArticlesForPressCenter();
        $blockSettings = BlockSettings::find()->one();
        $modelSubscribe = new NewsSubscribeForm();
//        if ($identity = Yii::$app->user->identity) {
//            $modelSubscribe->email = $identity->email;
//        }
        $news = News::find()->getActive()->orderBy('created_at DESC')->limit(3)->all();
        return $this->render('index',
            [
                'modelSubscribe' => $modelSubscribe,
                'selectedCity' => $this->selectedCity,
                'cities' => $cities,
                'services' => $services,
                'modelContact' => $modelContact,
                'articles' => $articles,
                'blockSettings' => $blockSettings,
                'news' => $news
            ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
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

    public function actionContact()
    {
        $model = new \app\models\Forms\ContactForm;
        $modelStore = new Feedback();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $email = Settings::find()->where(['id' => 3])->one();

        $post = Yii::$app->request->post();
        if($post) {
            $modelStore->attributes = Yii::$app->request->post('ContactForm');
            if($modelStore->validate() && $modelStore->save()) {
                $model->sendEmail(Yii::$app->request->post('ContactForm')['email'], $email->value, Yii::t('app', 'Обратная связь'),
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

    public function actionCallback()
    {
        $model = new \app\models\Forms\CallbackForm;
        $modelStore = new Callback();
        $email = Settings::find()->where(['id'=>3])->one();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $post = Yii::$app->request->post('CallbackForm');
        if($post) {
            if (!empty($post['time'])) {
                $post['message'] = !empty($post['message'])?
                    'Удобное время звонка:'. $post['time'].'<br>Сообщение:'.$post['message']:
                    'Удобное время звонка:' . $post['time'];
            } elseif (!empty($post['message'])) {
                $post['message'] = 'Сообщение:'. $post['message'];
            }
            $model->attributes = $post;
            $modelStore->attributes = $post;
            if ($modelStore->validate() && $modelStore->save()) {
                $model->sendEmail($modelStore->email, $email->value, Yii::t('app', 'Обратная связь'),
                    $this->renderPartial('@app/views/emails/email_feedback',
                        [
                            'model' => $modelStore,
                        ]
                    ));
                return ['success' => true];
            } else {
                return ['success' => false, 'errors' => $modelStore->errors];
            }

        }

        return ['success' => false];
    }
}
