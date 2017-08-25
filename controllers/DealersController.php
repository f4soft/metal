<?php
namespace app\controllers;


use app\components\AppController;
use app\models\DealersSettings;
use app\models\PagesImages;

class DealersController extends AppController
{
    public function actionIndex()
    {
        $dealers_settings = DealersSettings::find()->one();
        $head_img = PagesImages::find()->where(['slug' => 'dealers'])->one();

        return $this->render('index',
            [
                'dealersSettings' => $dealers_settings,
                'head_img' => $head_img,
            ]
        );
    }
}