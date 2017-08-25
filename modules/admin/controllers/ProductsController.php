<?php

namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\models\ProductsCategories;
use app\models\ProductsPricesToCities;
use app\modules\admin\components\AppController;
use Yii;
use app\models\Products;
use app\models\Filters\ProductsSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AppController
{
    use traits\Common;
    use traits\Upload;

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $additionalInfo = $model->productRelatedData;

        $categories = ProductsCategories::getCategoriesTree();
        $imageModel = new ImageUpload(Products::tableName());
        $post = Yii::$app->request->post();
        $preset_100 = '';

        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['articles']['admin'], 'view', 'image');
        }

        if ($post) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $post['Products']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['Products']['image'] =  str_replace(' ', '_', $post['Products']['image']);

            if($model->load($post) && $model->save()){
                if($imageModel->file instanceof UploadedFile) {
                    $imageModel->clearDirectory($model);
                    $imageModel->upload($model, Yii::$app->params['imagePresets']['products'], 'update');
                }
                foreach ($model->productRelatedData as $item) {
                    $item->price = $post['Products']['price'][$item->city_id];
                    $item->description_ru = $post['Products']['description_ru'][$item->city_id];
                    $item->description_en = $post['Products']['description_en'][$item->city_id];
                    $item->description_ua = $post['Products']['description_ua'][$item->city_id];
                    $item->save();
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    //'additionalInfo' => $additionalInfo,
                    'categories' => $categories,
                    'model' => $model,
                    "preset_100" => $preset_100
                ]);
            }
        } else {
            return $this->render('update', [
                //'additionalInfo' => $additionalInfo,
                'categories' => $categories,
                'model' => $model,
                "preset_100" => $preset_100
            ]);
        }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
