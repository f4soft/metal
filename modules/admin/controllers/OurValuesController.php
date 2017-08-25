<?php

namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\modules\admin\components\AppController;
use Yii;
use app\models\OurValues;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OurValuesController implements the CRUD actions for OurValues model.
 */
class OurValuesController extends AppController
{
    use traits\Delete;

    /**
     * Lists all OurValues models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OurValues::find(),
        ]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new OurValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OurValues();

        $imageModel = new ImageUpload(OurValues::tableName());
        if ($model->load(Yii::$app->request->post())) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->image = str_replace(' ', '_', $model->image);
            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['our-values'], 'create');
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
     * Updates an existing OurValues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageModel = new ImageUpload(OurValues::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = '';
        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['our-values']['main'], 'view', 'image');
        }
        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $post['OurValues']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['OurValues']['image'] =  str_replace(' ', '_', $post['OurValues']['image']);
            if($model->load($post) && $model->save()){
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['our-values'], 'update');
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    "preset_100" => $preset_100
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model, "preset_100" => $preset_100
            ]);
        }
    }

    /**
     * Finds the OurValues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OurValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OurValues::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
