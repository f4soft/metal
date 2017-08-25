<?php

namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\modules\admin\components\AppController;
use Yii;
use app\models\Services;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends AppController
{
    use traits\Delete;

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Services::find(),
        ]);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_ASC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Services();

        $imageModel = new ImageUpload(Services::tableName());
        $bigImageModel = new ImageUpload(Services::tableName());
        if ($model->load(Yii::$app->request->post())) {

            $imageModel->file = UploadedFile::getInstance($model, 'small_image');
            $model->small_image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->small_image = str_replace(' ', '_', $model->small_image);

            $bigImageModel->file = UploadedFile::getInstance($model, 'big_image');
            $model->big_image = !empty($bigImageModel->file) ? "{$bigImageModel->file->baseName}.{$bigImageModel->file->extension}" : '';
            $model->big_image = str_replace(' ', '_', $model->big_image);

            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['services-small'], 'create');
                $bigImageModel->upload($model, Yii::$app->params['imagePresets']['services-big'], 'create');
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
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageModel = new ImageUpload(Services::tableName());
        $bigImageModel = new ImageUpload(Services::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = $preset_big_100 = '';
        if($model->small_image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['services-small']['admin'], 'view', 'small_image');
        }

        if($model->big_image) {
            $preset_big_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['services-small']['admin'], 'view', 'big_image');
        }
        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'small_image');
            $bigImageModel->file = UploadedFile::getInstance($model, 'big_image');
            if($imageModel->file && $imageModel->file instanceof UploadedFile && $bigImageModel->file && $bigImageModel->file instanceof UploadedFile) {
                $imageModel->clearDirectory($model);
            }
            $post['Services']['small_image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->small_image;
            $post['Services']['small_image'] =  str_replace(' ', '_', $post['Services']['small_image']);

            $post['Services']['big_image'] = !empty($bigImageModel->file) ?
                "{$bigImageModel->file->baseName}.{$bigImageModel->file->extension}" : $model->big_image;
            $post['Services']['big_image'] =  str_replace(' ', '_', $post['Services']['big_image']);

            if($model->load($post) && $model->save()){
                if($imageModel->file && $imageModel->file instanceof UploadedFile) {
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['services-small'], 'update');
                }
                if($bigImageModel->file && $bigImageModel->file instanceof UploadedFile) {
                    $bigImageModel->upload($model, Yii::$app->params['imagePresets']['services-big'], 'update');
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    "preset_100" => $preset_100,
                    "preset_big_100" => $preset_big_100
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                "preset_100" => $preset_100,
                "preset_big_100" => $preset_big_100
            ]);
        }
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
