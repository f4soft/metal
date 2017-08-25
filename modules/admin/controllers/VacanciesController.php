<?php

namespace app\modules\admin\controllers;

use app\models\Cities;
use app\modules\admin\components\AppController;
use Yii;
use app\models\Vacancies;
use app\models\Filters\VacanciesSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacanciesController implements the CRUD actions for Vacancies model.
 */
class VacanciesController extends AppController
{
    use traits\Delete;
    use traits\Upload;

    /**
     * Lists all Vacancies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacanciesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Vacancies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacancies();
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
     * Updates an existing Vacancies model.
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
     * Finds the Vacancies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacancies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacancies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
