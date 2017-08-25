<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Sales;
use app\models\Filters\SalesSearch;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\AppController;
use app\models\ImageUpload;
use yii\web\UploadedFile;

/**
 * SalesController implements the CRUD actions for Sales model.
 */
class SalesController extends AppController
{
    use traits\Delete;

    /**
     * Lists all Sales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sales model.
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
     * Creates a new Sales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sales();

        $imageModel = new ImageUpload(Sales::tableName());
        if ($model->load(Yii::$app->request->post())) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->image = str_replace(' ', '_', $model->image);
            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['sales'], 'create');
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
    }

    /**
     * Updates an existing Sales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageModel = new ImageUpload(Sales::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = '';
        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['sales']['admin'], 'view', 'image');
        }
        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $post['Sales']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['Sales']['image'] =  str_replace(' ', '_', $post['Sales']['image']);
            if($model->load($post) && $model->save()){
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['sales'], 'update');
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model, "preset_100" => $preset_100
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model, "preset_100" => $preset_100
            ]);
        }
    }

    /**
     * Finds the Sales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
