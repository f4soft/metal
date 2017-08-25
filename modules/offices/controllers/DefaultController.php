<?php

namespace app\modules\offices\controllers;

use app\components\AppController;
use app\models\Cities;
use app\models\PagesImages;
use app\models\Departments;
use app\models\Forms\ContactForm;
use app\models\Forms\OfficesContactForm;
use app\modules\offices\Offices;
use Yii;
use app\models\BlockSettings;
use yii\web\Controller;

/**
 * Default controller for the `offices` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $blockSettings = BlockSettings::find()->one();
        $city = ($this->selectedCity) ? : 'kiev';

        $city = Cities::findOne(['alias' => $city]);
        $cities = Cities::find()->getActive()->all();

        $offices = \app\models\Offices::find()->getActive()->where(['city_id' => $city->id, 'status' => 1])->orderBy('is_main DESC, id ASC')->all();
        $departments = isset(\app\models\Offices::find()->getActive()->where(['city_id' => $city->id, 'is_main' => 1])->one()->departments) ?
            \app\models\Offices::find()->getActive()->where(['city_id' => $city->id, 'is_main' => 1])->one()->departments : false;

        $model = new OfficesContactForm();
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'offices'])->one();

        return $this->render('index',
            [
                'city' => $city->alias,
                'blockSettings' => $blockSettings,
                'offices' => $offices,
                'cities' => $cities,
                'departments' => $departments,
                'model' => $model,
                'modelContact' => $modelContact,
                'head_img' => $head_img,
            ]
        );
    }
}
