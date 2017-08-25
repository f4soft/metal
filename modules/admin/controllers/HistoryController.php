<?php

namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\modules\admin\components\AppController;
use Yii;
use app\models\History;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * HistoryController implements the CRUD actions for History model.
 */
class HistoryController extends AppController
{
    use traits\Delete;

    /**
     * Lists all History models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => History::find(),
        ]);
        $dataProvider->setPagination(['pageSize' => 15]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new History model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new History();
        $imageModel = new ImageUpload(History::tableName());

        if ($model->load(Yii::$app->request->post())) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}": '';
            $model->image = str_replace(' ', '_', $model->image);

            if ($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['history'], 'create');
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
     * Updates an existing History model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageModel = new ImageUpload(History::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = $model->image ? $imageModel->getImage($model, Yii::$app->params['imagePresets']['history']['admin'], 'view', 'image') : '';

        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');

            $post['History']['image'] = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['History']['image'] = str_replace(" ", "_", $post['History']['image']);

            if($model->load($post) && $model->save()) {
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['history'], 'update');
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'preset_100' => $preset_100
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'preset_100' => $preset_100
            ]);
        }
    }

    /**
     * Finds the History model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return History the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = History::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
