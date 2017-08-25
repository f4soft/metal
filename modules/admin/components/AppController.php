<?php

namespace app\modules\admin\components;

use yii\behaviors\TimestampBehavior;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class AppController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'root','is-main', 'import-cities', 'import-categories', 'import-products', 'upload', 'upload-products'],
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
//                    $this->redirect(Yii::app()->createUrl('site/login'));
                    $this->redirect('site/login');
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
}