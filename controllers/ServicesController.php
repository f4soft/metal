<?php

namespace app\controllers;


use app\components\AppController;
use app\models\BlockSettings;
use app\models\PagesImages;
use app\models\Forms\ContactForm;
use app\models\Services;

class ServicesController extends AppController
{
    public function actionIndex()
    {
        $block_settings = BlockSettings::find()->one();
        $services = Services::getAll();
        $modelContact = new ContactForm();

        $head_img = PagesImages::find()->where(['slug' => 'services'])->one();
        return $this->render('index', [
            'block_settings' => $block_settings,
            'services' => $services,
            'selectedCity' => $this->selectedCity,
            'modelContact' => $modelContact,
            'head_img' => $head_img,
        ]);
    }
    
    public function actionView($id)
    {
        $modelService = new Services();
        $modelContact = new ContactForm();
                        
        $service = $modelService->findOne(['alias' => $id]);       
        if(!$service){
            throw new NotFoundHttpException();
        }
        
        $block_settings = BlockSettings::find()->one();
        $head_img = PagesImages::find()->where(['slug' => 'services'])->one();
        
        return $this->render('view', [
            'service' => $service,
            'selectedCity' => $this->selectedCity,
            'head_img' => $head_img,
            'block_settings' => $block_settings,
            'modelContact' => $modelContact,
        ]);
    }
    
    
}