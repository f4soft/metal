<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Articles;
use app\models\Filters\ArticlesSearch;
use yii\filters\VerbFilter;
use app\modules\admin\components\AppController;
use yii\web\NotFoundHttpException;
use app\models\ImageUpload;
use yii\web\UploadedFile;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends AppController
{
    use traits\Delete;
    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articles();

        $imageModel = new ImageUpload(Articles::tableName());
        if ($model->load(Yii::$app->request->post())) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->image = str_replace(' ', '_', $model->image);
            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['articles'], 'create');
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
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageModel = new ImageUpload(Articles::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = '';
        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['articles']['admin'], 'view', 'image');
        }
        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $post['Articles']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['Articles']['image'] =  str_replace(' ', '_', $post['Articles']['image']);
            if($model->load($post) && $model->save()){
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['articles'], 'update');
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
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
