<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AppController;
use Yii;
use app\models\Reports;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReportsController implements the CRUD actions for Reports model.
 */
class ReportsController extends AppController
{
    use traits\Delete;

    /**
     * Lists all Reports models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Reports::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 15]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Reports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reports();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file && $model->validate()) {
                $model->upload($model->file);
                $model->file = "{$model->file->baseName}.{$model->file->extension}";
                $model->file = str_replace(' ', '_', $model->file);
                if($model->save()){
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        $fileName = $model->file ? $model->file : false;
        if ($post) {
            $fileModel = UploadedFile::getInstance($model, 'file') ? UploadedFile::getInstance($model, 'file') : $model->file;
            $post['Reports']['file'] = ($fileModel instanceof UploadedFile) ? $fileModel : $model->file;
            if($model->load($post) && $model->validate()) {
                if($fileModel instanceof UploadedFile) {
                    $model->upload($fileModel);
                    $model->file = "{$fileModel->baseName}.{$fileModel->extension}";
                    $model->file = str_replace(' ', '_', $model->file);
                }
                if($model->save()){
                    return $this->redirect(['index']);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'fileName' => $fileName
            ]);
        }
    }

    /**
     * Finds the Reports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reports::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
