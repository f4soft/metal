<?php

namespace app\modules\admin\controllers;

use app\models\Cities;
use app\modules\admin\components\AppController;
use Yii;
use app\models\Offices;
use app\models\Filters\OfficesSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficesController implements the CRUD actions for Offices model.
 */
class OfficesController extends AppController
{
    use traits\Delete;
    /**
     * Lists all Offices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfficesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 15]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Offices model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Offices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Offices();
        $cities = ArrayHelper::map(Cities::find()->getActive()->all(), 'id', 'title');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cities' => $cities
            ]);
        }
    }

    /**
     * Updates an existing Offices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cities = ArrayHelper::map(Cities::find()->getActive()->all(), 'id', 'title');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cities' => $cities
            ]);
        }
    }

    /**
     * Finds the Offices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIsMain($cityID)
    {
        return Json::encode(Offices::find()->where(['city_id' => $cityID, 'is_main' => 1])->all());
    }
}
