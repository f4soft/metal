<?php
namespace app\commands;


use app\components\Helper;
use app\models\BaseModel;
use app\models\BlockSettings;
use app\models\CronLog;
use app\models\News;
use app\models\NewsSubcribers;
use yii\console\Controller;
use app\models\Sales;

class NewsletterController extends Controller
{
    public function actionIndex()
    {
        $users = NewsSubcribers::find()->all();
        $model = new BaseModel();
        $cronLog = new CronLog();

        $isNewsletterEnabled = BlockSettings::find()->one();
        $isCronWasRan = false;
        if ($isNewsletterEnabled->newsletter_enable && $users) {
            foreach ($users as $user) {
                Helper::setUserNewsletterLanguage($user->language);
                if ($user->hash && $user->confirmed_at) {
                    if(CronLog::isCronWasRun()) {
                        $lastCronRun = CronLog::getLastRow()['last_date_run'];
                        $today = time();
                        $sales = Sales::find()->getActive()->orderBy('id DESC')
                            ->where(['between', 'created_at', "$lastCronRun", "$today" ])
                            ->limit(2)->all();
                        $news = News::find()->getActive()->orderBy('id DESC')
                            ->where(['between', 'created_at', "$lastCronRun", "$today" ])
                            ->limit(3)->all();
                        if($sales || $news) {
                            $body = $this->renderPartial('@app/views/emails/newsletter',
                                [
                                    'user' => $user,
                                    'news' => $news,
                                    'lang' => $user->language,
                                    'sales' => $sales
                                ]
                            );
                            $model->sendEmail(\Yii::$app->params['adminEmail'], $user->email, \Yii::t('app',
                                'Новостная рассылка'), $body
                            );
                            $isCronWasRan = true;
                        }
                    } else {
                        $sales = Sales::find()->getActive()->orderBy('id DESC')->limit(2)->all();
                        $news = News::find()->getActive()->orderBy('id DESC')->limit(3)->all();
                        $body = $this->renderPartial('@app/views/emails/newsletter',
                            [
                                'user' => $user,
                                'news' => $news,
                                'lang' => $user->language,
                                'sales' => $sales
                            ]
                        );
                        $model->sendEmail(\Yii::$app->params['adminEmail'], $user->email, \Yii::t('app',
                            'Новостная рассылка'), $body
                        );
                        $isCronWasRan = true;
                    }
                }
            }
            if($isCronWasRan) {
                $cronLog->last_date_run = time();
                $cronLog->save();
            }
        }
    }
}
