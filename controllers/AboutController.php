<?php
namespace app\controllers;


use app\components\AppController;
use app\models\BlockSettings;
use app\models\PagesImages;
use app\models\User;
use app\models\Cities;
use app\models\Forms\ContactForm;
use app\models\History;
use app\models\OurValues;
use app\models\Reports;
use app\models\Team;
use app\models\Polls;
use Yii;
use yii\web\Response;
use yii\web\Cookie;

class AboutController extends AppController
{
    public function actionIndex()
    {
        $histories = History::find()->getActive()->orderBy('title ASC')->all();
        $block_settings = BlockSettings::find()->one();
        $ourValues = OurValues::getAll();
        $employes = Team::getAll();
        $reports = Reports::getAll();
        $cities = Cities::find()->getActive()->all();
        $modelContact = new ContactForm();
        $blockSettings = BlockSettings::find()->one();
        $head_img = PagesImages::find()->where(['slug'=>'about'])->one();

        /**
         * Polls
         */
        /*If not answer show pool other show answers*/
        $poll = Polls::getLastPoll();
        $answers = !is_null($poll)? $poll->getPollQuestions():null;

        return $this->render('index',
            [
                'histories' => $histories,
                'block_settings' => $block_settings,
                'ourValues' => $ourValues,
                'employes' => $employes,
                'reports' => $reports,
                'poll' => $poll,
                'answers' => $answers,
                'cities' => $cities,
                'modelContact' => $modelContact,
                'selectedCity' => $this->selectedCity,
                'blockSettings' => $blockSettings,
                'head_img' => $head_img,
            ]
        );
    }

    public function actionPoolAnswers()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $err = 'Заполните поле Емайл';
        if (!empty($post['email'])) {
       /*проверить есть ли юзер, голосовал ли он, показать ошибки*/
            $identity = Yii::$app->user->identity;
            if (is_null($identity)) {
                $identity = User::findOne(['email' => trim($post['email'])]);
            }
            if (is_null($identity)) {
                $err = 'Пользователь не найден';
                return ['success' => false, 'error' => $err];
            } else {
                // logs in the user
                Yii::$app->user->login($identity);
                $poll = Polls::getLastPoll();
                if ($poll->isUserVote()) {
                    return ['success' => true, 'html' => $this->renderPartial(
                        '@app/views/about/inc/answers',
                        ['answers' => $poll->getPollQuestions()]
                    )];
                } else {
                    /*сохранить ответы, поставить юзеру куку*/
                        $poll->saveAnswers($post,$identity->id);
                        Yii::$app->response->cookies->add(new Cookie([
                            'name' => 'pool_'. $poll->id,
                            'value' => $poll->id
                        ]));
                    return ['success' => true, 'html'=> $this->renderPartial(
                        '@app/views/about/inc/answers',
                        ['answers' => $poll->getPollQuestions()]
                    )];
                }
            }
        }
        return ['success' => false, 'error' =>$err];
    }
}