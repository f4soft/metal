<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\components\AppController;
use app\models\ImageUpload;
use app\models\Team;
use app\models\Filters\TeamSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends AppController
{
    use traits\Delete;
    /**
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 15]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Team();
        $imageModel = new ImageUpload(Team::tableName());
        if ($model->load(Yii::$app->request->post())) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->image = str_replace(' ', '_', $model->image);
            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['team'], 'create');
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
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $imageModel = new ImageUpload(Team::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = '';
        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['team']['admin'], 'view', 'image');
        }
        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $post['Team']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['Team']['image'] =  str_replace(' ', '_', $post['Team']['image']);
            if($model->load($post) && $model->save()){
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['team'], 'update');
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
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
