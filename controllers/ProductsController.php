<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/2/16
 * Time: 1:40 PM
 */

namespace app\controllers;


use app\components\AppController;
use app\components\SeoTagsUtility;
use app\models\Cities;
use app\models\Forms\ContactForm;
use app\models\Products;
use app\models\ProductsCategories;
use app\models\Sales;
use yii\web\NotFoundHttpException;

class ProductsController extends AppController
{
    public function actionIndex($alias)
    {
        $relatedCategories = false;
        $sales = ProductsCategories::getSubcategorySaleRand();
        $product = Products::findOne(['alias' => $alias]);

        $modelContact = new ContactForm();

        if(!$product) {
            throw new NotFoundHttpException();
        }
        SeoTagsUtility::setProductMetaTags($product);
        if($relIDs = ProductsCategories::findOne(['id' => $product->category_id])->related_categories_id) {
            $relatedCategories = ProductsCategories::getRelatedCategories($relIDs);
        }

        return $this->render('index', [
            'selectedCity' => $this->selectedCity,
            'sales' => $sales,
            'product' => $product,
            'modelContact' => $modelContact,
            'subcategory' => $product->productCategory,
            'city' => Cities::getByAliasOrKiev($this->selectedCity),
            'relatedCategories' => $relatedCategories,
        ]);
    }
}
