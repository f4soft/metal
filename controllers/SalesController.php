<?php
namespace app\controllers;


use app\components\AppController;
use app\components\SeoTagsUtility;
use app\models\BlockSettings;
use app\models\PagesImages;
use app\models\Forms\ContactForm;
use app\models\ProductsCategories;
use app\models\Services;
use app\models\Cities;
use Yii;
use app\models\ImageUpload;
use app\models\Sales;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class SalesController extends AppController
{

    public function actionIndex()
    {
        $modelContact = new ContactForm();
        $sales = new ActiveDataProvider([
            'query' => Sales::find()->getActive()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
        $city = isset(Yii::$app->request->get()['city']) ? Yii::$app->request->get()['city'] : '';
        $blockSettings = BlockSettings::find()->one();

        $head_img = PagesImages::find()->where(['slug' => 'sales'])->one();
        return $this->render('index',
            [
                'blockSettings' => $blockSettings,
                'sales'=> $sales,
                'city' => $city,
                'selectedCity' => $this->selectedCity,
                'modelContact' => $modelContact,
                'head_img' => $head_img,
            ]
        );
    }

    public function actionView($id)
    {
        $model = Sales::find()->where(["alias"=>$id])->getActive()->one();
        if (!$model)
            throw new \yii\web\NotFoundHttpException;
        $imageModel = new ImageUpload(Sales::tableName());
        $image = $imageModel->getImage($model, \Yii::$app->params['imagePresets']['news']['oneNews'], 'view', 'image');
        $city = isset(Yii::$app->request->get()['city']) ? Yii::$app->request->get()['city'] : '';
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'sales'])->one();
        return $this->render('view',
            [
                'model' => $model,
                'image' => "/{$image}",
                'city' => $city,
                'selectedCity' => $this->selectedCity,
                'modelContact' => $modelContact,
                'head_img' => $head_img,
            ]);
    }
    
    public function actionCatalog()
    {        
        $modelContact = new \app\models\Forms\ContactForm();
        $sales = Sales::getSales();
        $rootCategories = ProductsCategories::getCategorieSaleRoot();
        
        $blockSettings = BlockSettings::find()->one();
        $head_img = PagesImages::find()->where(['slug' => 'sales'])->one();
        return $this->render('catalog', [
            'modelContact' => $modelContact,
            'sales' => $sales,
            'selectedCity' => $this->selectedCity,
            'rootCategories' => $rootCategories,
            'blockSettings' => $blockSettings,
            'head_img' => $head_img,
        ]);
    }
    
    public function actionCategory($category)
    {
        $category = ProductsCategories::findOne(['alias' => $category]);
        if (!$category) {
            throw new NotFoundHttpException();
        }       
        if(!ProductsCategories::checkSales($category->lft, $category->rgt)){
            return $this->redirect(['sales/index']);
        }
        SeoTagsUtility::setCategoryMetaTags($category, 'sales');
        
//        $root = Yii::getAlias('@webroot');
//        $files = ['filePrice' => '', 'priceImage' => ''];
//        if ($category->show_price) {
//            $filePrice = '/uploads/prices/' . $category->id . '/' . $category->file_price;
//            if (is_file($root . $filePrice)) {
//                $files['filePrice'] = $filePrice;
//            }
//            $priceImage = Yii::getAlias('@web/' . $category->getPriceImagePath());
//            if (is_file($root . $priceImage)) {
//                $files['priceImage'] = $priceImage;
//            }
//        }

        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'sales'])->one();
        return $this->render('category', [
            'category' => $category,
            'modelContact' => $modelContact,
            'selectedCity' => $this->selectedCity,
            'city' => Cities::getByAliasOrKiev($this->selectedCity),
//            'files' => $files,
            'head_img' => $head_img,
        ]);
    }
    
    public function actionSubcategory($category, $subcategory)
    {     
        $category = ProductsCategories::findOne(['alias' => $category]);
        if (!$category) {
            throw new NotFoundHttpException();
        }
        $subcategory = ProductsCategories::findOne(['alias' => $subcategory]);
        if (!$subcategory) {
            throw new NotFoundHttpException();
        }
        if(!ProductsCategories::checkSales($subcategory->lft, $subcategory->rgt)){
            return $this->redirect(['sales/index']);
        }        

        SeoTagsUtility::setSubCategoryMetaTags($subcategory, 'sales');

        $modelContact = new ContactForm();
        $services = Services::getAll();
        $products = $subcategory->productsale;
        $allSubcategorySale = ProductsCategories::getCategoriesSaleChildren($category);
        if(\Yii::$app->request->post()){
            $subcategory = ProductsCategories::findOne(['id' => \Yii::$app->request->post()['category']]);
            $this->redirect(Url::to(["/{$this->selectedCity}/sales/{$category->alias}/{$subcategory->alias}"]));
        }
//        $root = Yii::getAlias('@webroot');
//        $files = ['filePrice'=>'','priceImage'=>'','fileCatalog'=>'','fileImage'=>'',];
//        if ($category->show_price) {
//            $filePrice = '/uploads/prices/' . $category->id . '/' . $category->file_price;
//            if (is_file($root . $filePrice)) {
//                $files['filePrice'] = $filePrice;
//            }
//            $priceImage = Yii::getAlias('@web/' . $category->getPriceImagePath());
//            if (is_file($root . $priceImage)) {
//                $files['priceImage'] = $priceImage;
//            }
//        }
//        if ($category->show_catalog) {
//            $fileCatalog = '/uploads/catalogs/' . $category->id . '/' . $category->file_catalog;
//            if (is_file($root . $fileCatalog)) {
//                $files['fileCatalog'] = $fileCatalog;
//            }
//            $fileImage = '/' . $category->getCatalogImagePath();
//            if (is_file($root . $fileImage)) {
//                $files['fileImage'] = $fileImage;
//            }
//        }
        
        $rowShow = [ 
            25 => Yii::t('app', 'Отображать на сайте по').' 25', 
            50 => Yii::t('app', 'Отображать на сайте по').' 50', 
            75 => Yii::t('app', 'Отображать на сайте по').' 75', 
            100 => Yii::t('app', 'Отображать на сайте по').' 100',
            5000 => Yii::t('app', 'Отображать все')
        ];
        
        $head_img = PagesImages::find()->where(['slug' => 'sales'])->one();
        return $this->render('subcategory', [
            'subcategory' => $subcategory,
            'category' => $category,
            'modelContact' => $modelContact,
            'services' => $services,
            'selectedCity' => $this->selectedCity,
            'products' => $products,
            'city' => Cities::getByAliasOrKiev($this->selectedCity),
            'allSubcategorySale' => $allSubcategorySale,
            'head_img' => $head_img,
            'rowShow' => $rowShow,
        ]);
    }
}