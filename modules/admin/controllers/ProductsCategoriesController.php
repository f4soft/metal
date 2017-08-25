<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductsCategories;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\AppController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\ImageUpload;

/**
 * ProductsCategoriesController implements the CRUD actions for ProductsCategories model.
 */
class ProductsCategoriesController extends AppController
{
    use traits\Common;
    use traits\Upload;
    /**
     * Lists all ProductsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductsCategories::find()->where(['<>', 'alias', 'menu'])->orderBy('lft'),
        ]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 200]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ProductsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return false;
        $model = new ProductsCategories();
        $imageModel = new ImageUpload(ProductsCategories::tableName());
        $root = ProductsCategories::findOne(['alias' => 'menu']);
        $rootCategories = ArrayHelper::map($root->children(1)->all(), 'id', 'title_ru');
        $rootCategories[$root->id] = Yii::t("app", "Родительская категория");
        ksort($rootCategories);
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            $model->filePrice = UploadedFile::getInstance($model, 'file_price');
            $model->imagePrice = UploadedFile::getInstance($model, 'image_price');

            $model->fileCatalog = UploadedFile::getInstance($model, 'file_catalog');
            $model->imageCatalog = UploadedFile::getInstance($model, 'image_catalog');
            
            $model->image = !empty($imageModel->file) ? "{$imageModel->file->baseName}.{$imageModel->file->extension}" : '';
            $model->image = str_replace(' ', '_', $model->image);

            $model->file_price = !empty($model->file_price) ? "{$model->filePrice->baseName}.{$imageModel->filePrice->extension}" : '';
            $model->file_price = str_replace(' ', '_', $model->file_price);

            $model->image_price = !empty($model->image_price) ? "{$model->imagePrice->baseName}.{$imageModel->imagePrice->extension}" : '';
            $model->image_price = str_replace(' ', '_', $model->image_price);

            $model->file_catalog = !empty($model->file_catalog) ? "{$model->fileCatalog->baseName}.{$imageModel->fileCatalog->extension}" : '';
            $model->file_catalog = str_replace(' ', '_', $model->file_catalog);

            $model->image_catalog = !empty($model->image_catalog) ? "{$model->imageCatalog->baseName}.{$imageModel->imageCatalog->extension}" : '';
            $model->image_catalog = str_replace(' ', '_', $model->image_catalog);
            
             if($parent = $post['ProductsCategories']['parent_id']) {
                 $root = ProductsCategories::find()->where("id =:id", [':id' => $parent])->one();
                 $model->appendTo($root);
             } else {
                $model->makeRoot();
             }
            $model->uploadPrice();
            $model->uploadPriceImage();

            $model->uploadCatalog();
            $model->uploadCatalogImage();
            $imageModel->upload($model, Yii::$app->params['imagePresets']['categories'], 'create');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'rootCategories' => $rootCategories ? $rootCategories : [],
            ]);
        }
    }

    /**
     * Updates an existing ProductsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($parent = $model->parents(1)->one()) {
            $model->parent_id = $parent->id;
        }

        $imageModel = new ImageUpload(ProductsCategories::tableName());
        $preset_100 = $preset_price_100 = $preset_catalog_100 = '';
//        $priceName = $model->file_price ? $model->file_price : "";
        $priceName = $model->getPriceFiles();
        $catalogName = $model->getCatalogFiles();
        if($model->image) {
            $preset_100 = $imageModel->getImage($model, Yii::$app->params['imagePresets']['categories']['admin'], 'view', 'image');
        }

//        if ($model->image_price){
//            $preset_price_100 = $model->getPriceImagePath();
//        }
//
//        if ($model->image_catalog){
//            $preset_catalog_100 = $model->getCatalogImagePath();
//        }

        $preset_price_100 = $model->getPriceImagesFiles();
        $preset_catalog_100 = $model->getCatalogImagesFiles();

        $post = Yii::$app->request->post();

        if($post && $model->validate()) {
            $imageModel->file = UploadedFile::getInstance($model, 'image');
            if($imageModel->file) {
                $imageModel->clearDirectory($model);
            }
            $model->filePriceRu = UploadedFile::getInstance($model, 'file_price_ru');
            $model->filePriceUa = UploadedFile::getInstance($model, 'file_price_ua');
            $model->filePriceEn = UploadedFile::getInstance($model, 'file_price_en');
            $model->imagePriceRu = UploadedFile::getInstance($model, 'image_price_ru');
            $model->imagePriceUa = UploadedFile::getInstance($model, 'image_price_ua');
            $model->imagePriceEn = UploadedFile::getInstance($model, 'image_price_en');

            $model->fileCatalogRu = UploadedFile::getInstance($model, 'file_catalog_ru');
            $model->fileCatalogUa = UploadedFile::getInstance($model, 'file_catalog_ua');
            $model->fileCatalogEn = UploadedFile::getInstance($model, 'file_catalog_en');
            $model->imageCatalogRu = UploadedFile::getInstance($model, 'image_catalog_ru');
            $model->imageCatalogUa = UploadedFile::getInstance($model, 'image_catalog_ua');
            $model->imageCatalogEn = UploadedFile::getInstance($model, 'image_catalog_en');

            $post['ProductsCategories']['image'] = !empty($imageModel->file) ?
                "{$imageModel->file->baseName}.{$imageModel->file->extension}" : $model->image;
            $post['ProductsCategories']['image'] = str_replace(' ', '_', $post['ProductsCategories']['image']);
            $model->image = $post['ProductsCategories']['image'];

            $post['ProductsCategories']['file_price_ru'] = !empty($model->filePriceRu) ?
                "{$model->filePriceRu->baseName}.{$model->filePriceRu->extension}" : $model->file_price_ru;
            $post['ProductsCategories']['file_price_ru'] = str_replace(' ', '_', $post['ProductsCategories']['file_price_ru']);
            $model->file_price_ru = $post['ProductsCategories']['file_price_ru'];

            $post['ProductsCategories']['file_price_ua'] = !empty($model->filePriceUa) ?
                "{$model->filePriceUa->baseName}.{$model->filePriceUa->extension}" : $model->file_price_ua;
            $post['ProductsCategories']['file_price_ua'] = str_replace(' ', '_', $post['ProductsCategories']['file_price_ua']);
            $model->file_price_ua = $post['ProductsCategories']['file_price_ua'];

            $post['ProductsCategories']['file_price_en'] = !empty($model->filePriceEn) ?
                "{$model->filePriceEn->baseName}.{$model->filePriceEn->extension}" : $model->file_price_en;
            $post['ProductsCategories']['file_price_en'] = str_replace(' ', '_', $post['ProductsCategories']['file_price_en']);
            $model->file_price_en = $post['ProductsCategories']['file_price_en'];

            $post['ProductsCategories']['image_price_ru'] = !empty($model->imagePriceRu) ?
                "{$model->imagePriceRu->baseName}.{$model->imagePriceRu->extension}" : $model->image_price_ru;
            $post['ProductsCategories']['image_price_ru'] = str_replace(' ', '_', $post['ProductsCategories']['image_price_ru']);
            $model->image_price_ru = $post['ProductsCategories']['image_price_ru'];

            $post['ProductsCategories']['image_price_ua'] = !empty($model->imagePriceUa) ?
                "{$model->imagePriceUa->baseName}.{$model->imagePriceUa->extension}" : $model->image_price_ua;
            $post['ProductsCategories']['image_price_ua'] = str_replace(' ', '_', $post['ProductsCategories']['image_price_ua']);
            $model->image_price_ua = $post['ProductsCategories']['image_price_ua'];

            $post['ProductsCategories']['image_price_en'] = !empty($model->imagePriceEn) ?
                "{$model->imagePriceEn->baseName}.{$model->imagePriceEn->extension}" : $model->image_price_en;
            $post['ProductsCategories']['image_price_en'] = str_replace(' ', '_', $post['ProductsCategories']['image_price_en']);
            $model->image_price_en = $post['ProductsCategories']['image_price_en'];

            $post['ProductsCategories']['file_catalog_ru'] = !empty($model->fileCatalogRu) ?
                "{$model->fileCatalogRu->baseName}.{$model->fileCatalogRu->extension}" : $model->file_catalog_ru;
            $post['ProductsCategories']['file_catalog_ru'] = str_replace(' ', '_', $post['ProductsCategories']['file_catalog_ru']);
            $model->file_catalog_ru = $post['ProductsCategories']['file_catalog_ru'];

            $post['ProductsCategories']['file_catalog_ua'] = !empty($model->fileCatalogUa) ?
                "{$model->fileCatalogUa->baseName}.{$model->fileCatalogUa->extension}" : $model->file_catalog_ua;
            $post['ProductsCategories']['file_catalog_ua'] = str_replace(' ', '_', $post['ProductsCategories']['file_catalog_ua']);
            $model->file_catalog_ua = $post['ProductsCategories']['file_catalog_ua'];

            $post['ProductsCategories']['file_catalog_en'] = !empty($model->fileCatalogEn) ?
                "{$model->fileCatalogEn->baseName}.{$model->fileCatalogEn->extension}" : $model->file_catalog_en;
            $post['ProductsCategories']['file_catalog_en'] = str_replace(' ', '_', $post['ProductsCategories']['file_catalog_en']);
            $model->file_catalog_en = $post['ProductsCategories']['file_catalog_en'];

            $post['ProductsCategories']['image_catalog_ru'] = !empty($model->imageCatalogRu) ?
                "{$model->imageCatalogRu->baseName}.{$model->imageCatalogRu->extension}" : $model->image_catalog_ru;
            $post['ProductsCategories']['image_catalog_ru'] = str_replace(' ', '_', $post['ProductsCategories']['image_catalog_ru']);
            $model->image_catalog_ru = $post['ProductsCategories']['image_catalog_ru'];

            $post['ProductsCategories']['image_catalog_ua'] = !empty($model->imageCatalogUa) ?
                "{$model->imageCatalogUa->baseName}.{$model->imageCatalogUa->extension}" : $model->image_catalog_ua;
            $post['ProductsCategories']['image_catalog_ua'] = str_replace(' ', '_', $post['ProductsCategories']['image_catalog_ua']);
            $model->image_catalog_ua = $post['ProductsCategories']['image_catalog_ua'];

            $post['ProductsCategories']['image_catalog_en'] = !empty($model->imageCatalogEn) ?
                "{$model->imageCatalogEn->baseName}.{$model->imageCatalogEn->extension}" : $model->image_catalog_en;
            $post['ProductsCategories']['image_catalog_en'] = str_replace(' ', '_', $post['ProductsCategories']['image_catalog_en']);
            $model->image_catalog_en = $post['ProductsCategories']['image_catalog_en'];

            $model->load($post);
            if($parent = $post['ProductsCategories']['parent_id']) {
                $root = ProductsCategories::find()->where("id =:id", [':id' => $parent])->one();
                if(!$model->isChildOf($root)) {
                    $model->appendTo($root);
                }
            } elseif(!$model->isRoot()) {
                $model->makeRoot();
            }
            if($model->save()){
                $imageModel->upload($model, Yii::$app->params['imagePresets']['categories'], 'update');
                $model->filePriceRu ? $model->uploadPrice('ru') : false;
                $model->filePriceUa ? $model->uploadPrice('ua') : false;
                $model->filePriceEn ? $model->uploadPrice('en') : false;
                $model->imagePriceRu ? $model->uploadPriceImage('ru') : false;
                $model->imagePriceUa ? $model->uploadPriceImage('ua') : false;
                $model->imagePriceEn ? $model->uploadPriceImage('en') : false;

                $model->fileCatalogRu ? $model->uploadCatalog('ru') : false;
                $model->fileCatalogUa ? $model->uploadCatalog('ua') : false;
                $model->fileCatalogEn ? $model->uploadCatalog('en') : false;
                $model->imageCatalogRu ? $model->uploadCatalogImage('ru') : false;
                $model->imageCatalogUa ? $model->uploadCatalogImage('ua') : false;
                $model->imageCatalogEn ? $model->uploadCatalogImage('en') : false;
                return $this->redirect('index');
            }
        } else {
            $root = ProductsCategories::findOne(['alias' => 'menu']);
            $rootCategories = ArrayHelper::map($root->children(1)->all(), 'id', 'title_ru');
            $rootCategories[$root->id] = Yii::t("app", "Родительская категория");
            ksort($rootCategories);

            return $this->render('update', [
                'model' => $model,
                'priceName' => $priceName,
                'catalogName' => $catalogName,
                'preset_100' => $preset_100,
                'preset_price_100' => $preset_price_100,
                'preset_catalog_100' => $preset_catalog_100,
                'rootCategories' => $rootCategories,
            ]);
        }
    }

    /**
     * Finds the ProductsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductsCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRoot()
    {
        $root = new ProductsCategories(['title_ru' => 'Menu', 'title_ua' => 'Menu', 'title_en' => 'Menu']);
        $root->makeRoot();
    }
}
