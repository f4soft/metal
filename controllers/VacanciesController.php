<?php
namespace app\controllers;

use app\components\Helper;
use Yii;
use app\components\AppController;
use app\models\BlockSettings;
use app\models\PagesImages;
use app\models\Cities;
use app\models\Vacancies;
use app\models\VacancyForm;
use app\models\Settings;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

class VacanciesController extends AppController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'send' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $model = new VacancyForm();
        $block_settings = BlockSettings::find()->one();
        $selectedCity = null;
        $post = \Yii::$app->request->post();
        $cities = Cities::getAll();
        $vacancies = Vacancies::getAll();
        $city = isset(\Yii::$app->request->get()['city']) ? \Yii::$app->request->get()['city'] : '';

        $head_img = PagesImages::find()->where(['slug' => 'vacancies'])->one();
        if($post) {
            $selectedCity = $post['city'] ? Cities::findOne($post['city']) : $selectedCity;
            $vacancies = $post['city'] ? Vacancies::getVacanciesById($post['city']) : $vacancies;
            return $this->render('index', [
                'block_settings' => $block_settings,
                'cities' => $cities,
                'selectedCity' => $selectedCity,
                'vacancies' => $vacancies,
                'model' => $model,
                'city' => $city,
                'head_img' => $head_img,
            ]);
        }


        return $this->render('index',
            [
                'block_settings' => $block_settings,
                'cities' => $cities,
                'selectedCity' => $selectedCity,
                'vacancies' => $vacancies,
                'model' => $model,
                'city' => $this->selectedCity,
                'head_img' => $head_img,
            ]
        );
    }

    public function actionSend()
    {
        //Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $model = new VacancyForm();
        $model->load($post, 'VacancyForm');
        $model->file = UploadedFile::getInstance($model,'file');
        $vacancy = Vacancies::findOne(['id' => $post['VacancyForm']['vacancy_id']]);
        $adminEmail = Settings::find()->where(['const_name'=>'VACANCIES_MAIL'])->one();
        $adminEmail = is_null($adminEmail)? Yii::$app->params['adminEmail']:$adminEmail->value;
        if($post) {
            if(isset($post['g-recaptcha-response']) && !$post['g-recaptcha-response']){
                $model->addError('captcha', \Yii::t('app', 'Заполните, пожалуйста, капчу!'));
                $block_settings = BlockSettings::find()->one();
                $selectedCity = null;
                $post = \Yii::$app->request->post();
                $cities = Cities::getAll();
                $vacancies = Vacancies::getAll();
                $city = isset(\Yii::$app->request->get()['city']) ? \Yii::$app->request->get()['city'] : '';
                return $this->render('index', [
                    'error' => $post['form_id'],
                    'block_settings' => $block_settings, 'cities' => $cities, 'selectedCity' => $selectedCity,
                    'vacancies' => $vacancies, 'model' => $model, 'city' => $this->selectedCity
                ]);
            } elseif(isset($post['g-recaptcha-response']) && $post['g-recaptcha-response']) {
                $postfields = [
                    'secret' => Yii::$app->params['recaptchaSecretKey'],
                    'response' => $post['g-recaptcha-response']
                ];
                $result = Helper::checkCaptcha($postfields);
                if(!$result['success']) {
                    $model->addError('captcha', \Yii::t('app', 'Заполните, пожалуйста, капчу!'));
                    $block_settings = BlockSettings::find()->one();
                    $selectedCity = null;
                    $post = \Yii::$app->request->post();
                    $cities = Cities::getAll();
                    $vacancies = Vacancies::getAll();
                    $city = isset(\Yii::$app->request->get()['city']) ? \Yii::$app->request->get()['city'] : '';
                    return $this->render('index', [
                        'error' => $post['form_id'],
                        'block_settings' => $block_settings, 'cities' => $cities, 'selectedCity' => $selectedCity,
                        'vacancies' => $vacancies, 'model' => $model, 'city' => $this->selectedCity
                    ]);
                }
            }
        }
        if($model->file) {
            $model->sendEmailWithAttach($model->email, $adminEmail, Yii::t('app', 'Вакансия на должность ') . " ". $vacancy->title, $this->renderPartial('@app/views/emails/vacancy',
                [
                    'vacancy' => $vacancy,
                    'model' => $model,
                ]
            ), $model->file);
        } else {
            $model->sendEmail($model->email, $adminEmail, Yii::t('app', 'Вакансия на должность ') . " " . $vacancy->title, $this->renderPartial('@app/views/emails/vacancy',
                [
                    'vacancy' => $vacancy,
                    'model' => $model,
                ]
            ));
        }
        return $this->redirect('/vacancies');
    }
}