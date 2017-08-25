<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/2/16
 * Time: 5:00 PM
 */

namespace app\controllers;


use app\components\AppController;

class SearchController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}