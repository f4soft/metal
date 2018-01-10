<?php
namespace app\controllers;

use app\components\AppController;
use app\components\SeoTagsUtility;
use app\models\BlockSettings;
use app\models\Cities;
use app\models\Forms\ContactForm;
use app\models\Products;
use app\models\ProductsCategories;
use app\models\Sales;
use app\models\Services;
use app\models\PagesImages;
use app\models\SeoTags;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Yii;

class CatalogController extends AppController
{
    public function actionIndex()
    {                
        $modelContact = new \app\models\Forms\ContactForm();
        $sales = ProductsCategories::getSubcategorySaleRand();        
        $rootCategories = ProductsCategories::getCategoriesRoots();
        $blockSettings = BlockSettings::find()->one();
        $head_img = PagesImages::find()->where(['slug' => 'catalog'])->one();
        return $this->render('index', [
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
        SeoTagsUtility::setCategoryMetaTags($category);
        $root = Yii::getAlias('@webroot');
        $files = ['filePrice' => '', 'priceImage' => ''];
        if ($category->show_price) {
            $filePrice = '/uploads/prices/' . $category->id . '/' . $category->file_price;
            if (is_file($root . $filePrice)) {
                $files['filePrice'] = $filePrice;
            }
            $priceImage = Yii::getAlias('@web/' . $category->getPriceImagePath());
            if (is_file($root . $priceImage)) {
                $files['priceImage'] = $priceImage;
            }
        }

        $sales = ProductsCategories::getSubcategorySaleRand();
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => $category->alias ])->one();
        return $this->render('category', [
            'category' => $category,
            'sales' => $sales,
            'modelContact' => $modelContact,
            'selectedCity' => $this->selectedCity,
            'files' => $files,
            'head_img' => $head_img,
            'city' => Cities::getByAliasOrKiev($this->selectedCity), 
            'seoTags' => SeoTags::findOne(['url' => Yii::$app->request->url]),
        ]);
    }

    public function actionSubcategory($category = "", $subcategory = "")
    {    
        $category = ProductsCategories::findOne(['alias' => $category]);
        if (!$category) {
            throw new NotFoundHttpException();
        }

        $subcategory = ProductsCategories::findOne(['alias' => $subcategory]);
        if (!$subcategory) {
            throw new NotFoundHttpException();
        }

        SeoTagsUtility::setSubCategoryMetaTags($subcategory);
        $sales = Sales::getSales();
        $modelContact = new ContactForm();
        $services = Services::getAll();

        $products = $subcategory->products;
//\yii\helpers\VarDumper::dump($products[0]);  exit();
        $allSubcategories = ProductsCategories::getCategoriesChildren($category);
        if(\Yii::$app->request->post()){
            $subcategory = ProductsCategories::findOne(['id' => \Yii::$app->request->post()['category']]);
            $this->redirect(Url::to(["/{$this->selectedCity}/catalog/{$category->alias}/{$subcategory->alias}"]));
        }
        $root = Yii::getAlias('@webroot');
        $files = ['filePrice'=>'','priceImage'=>'','fileCatalog'=>'','fileImage'=>'',];
        if ($category->show_price) {
            $filePrice = '/uploads/prices/' . $category->id . '/' . $category->file_price;
            if (is_file($root . $filePrice)) {
                $files['filePrice'] = $filePrice;
            }
            $priceImage = Yii::getAlias('@web/' . $category->getPriceImagePath());
            if (is_file($root . $priceImage)) {
                $files['priceImage'] = $priceImage;
            }
        }
        if ($category->show_catalog) {
            $fileCatalog = '/uploads/catalogs/' . $category->id . '/' . $category->file_catalog;
            if (is_file($root . $fileCatalog)) {
                $files['fileCatalog'] = $fileCatalog;
            }
            $fileImage = '/' . $category->getCatalogImagePath();
            if (is_file($root . $fileImage)) {
                $files['fileImage'] = $fileImage;
            }
        }

        $head_img = PagesImages::find()->where(['slug' => $category->alias])->one();
        
        $rowShow = [ 
            25 => Yii::t('app', 'Отображать на сайте по').' 25', 
            50 => Yii::t('app', 'Отображать на сайте по').' 50', 
            75 => Yii::t('app', 'Отображать на сайте по').' 75', 
            100 => Yii::t('app', 'Отображать на сайте по').' 100',
            5000 => Yii::t('app', 'Отображать все')
        ];
       
        return $this->render('subcategory', [
            'subcategory' => $subcategory,
            'category' => $category,
            'sales' => $sales,
            'modelContact' => $modelContact,
            'services' => $services,
            'selectedCity' => $this->selectedCity,
            'products' => $products,
            'city' => Cities::getByAliasOrKiev($this->selectedCity),
            'allSubcategories' => $allSubcategories,
            'files'=>$files,
            'head_img' => $head_img,
            'rowShow' => $rowShow,
            'seoTags' => SeoTags::findOne(['url' => Yii::$app->request->url]),
        ]);
    }
}