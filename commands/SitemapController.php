<?php

namespace app\commands;

use app\models\ProductsCategories;
use app\models\Cities;
use yii\console\Controller;

class SitemapController extends Controller
{
    public function actionCreate()
    {
        $homeUrl = \Yii::$app->params['homeUrl'];
        $xmlStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xmlStr .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        /*Home pages*/
        $xmlStr .= "<url>\n";
        $xmlStr .= "<loc>" . $homeUrl  . "</loc>\n";
        $xmlStr .= "<priority>1</priority>\n";
        $xmlStr .= "</url>\n";
//        $xmlStr .= "<url>\n";
//        $xmlStr .= "<loc>" . $homeUrl  . "ru</loc>\n";
//        $xmlStr .= "<priority>1</priority>\n";
//        $xmlStr .= "</url>\n";
        $xmlStr .= "<url>\n";
        $xmlStr .= "<loc>" . $homeUrl  . "ua</loc>\n";
        $xmlStr .= "<priority>1</priority>\n";
        $xmlStr .= "</url>\n";
//        $xmlStr .= "<url>\n";
//        $xmlStr .= "<loc>" . $homeUrl  . "en</loc>\n";
//        $xmlStr .= "<priority>1</priority>\n";
//        $xmlStr .= "</url>\n";
        /*Catalog categories, subcategories, goods*/
//        $xmlStr .= "<url>\n";
//        $xmlStr .= "<loc>" . $homeUrl . "ru/catalog/</loc>\n";
//        $xmlStr .= "<priority>1</priority>\n";
//        $xmlStr .= "</url>\n";
//        $xmlStr .= "<url>\n";
//        $xmlStr .= "<loc>" . $homeUrl . "ua/catalog/</loc>\n";
//        $xmlStr .= "<priority>1</priority>\n";
//        $xmlStr .= "</url>\n";
//        $xmlStr .= "<url>\n";
//        $xmlStr .= "<loc>" . $homeUrl . "en/catalog/</loc>\n";
//        $xmlStr .= "<priority>1</priority>\n";
//        $xmlStr .= "</url>\n";

        $rootCategories = ProductsCategories::getCategoriesRoots();
        foreach ($rootCategories as $rootCategory) {
            $xmlStr .= "<url>\n";
            $xmlStr .= "<loc>" . $homeUrl . "catalog/" . $rootCategory->alias . "</loc>\n";
            $xmlStr .= "<priority>0.8</priority>\n";
            $xmlStr .= "</url>\n";
            $xmlStr .= "<url>\n";
            $xmlStr .= "<loc>" . $homeUrl . "ua/catalog/" . $rootCategory->alias . "</loc>\n";
            $xmlStr .= "<priority>0.8</priority>\n";
            $xmlStr .= "</url>\n";
//            $xmlStr .= "<url>\n";
//            $xmlStr .= "<loc>" . $homeUrl . "en/catalog/" . $rootCategory->alias . "</loc>\n";
//            $xmlStr .= "<priority>0.8</priority>\n";
//            $xmlStr .= "</url>\n";
            $allSubcategories = ProductsCategories::getCategoriesChildren($rootCategory);
            foreach ($allSubcategories as $subcategory) {
                $xmlStr .= "<url>\n";
                $xmlStr .= "<loc>" . $homeUrl . "catalog/" . $rootCategory->alias . "/". $subcategory->alias. "</loc>\n";
                $xmlStr .= "<priority>0.8</priority>\n";
                $xmlStr .= "</url>\n";
                $xmlStr .= "<url>\n";
                $xmlStr .= "<loc>" . $homeUrl . "ua/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "</loc>\n";
                $xmlStr .= "<priority>0.8</priority>\n";
                $xmlStr .= "</url>\n";
//                $xmlStr .= "<url>\n";
//                $xmlStr .= "<loc>" . $homeUrl . "en/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "</loc>\n";
//                $xmlStr .= "<priority>0.8</priority>\n";
//                $xmlStr .= "</url>\n";
                $products = $subcategory->products;
                foreach ($products as $product) {
                    $xmlStr .= "<url>\n";
                    $xmlStr .= "<loc>" . $homeUrl . "catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "/".$product->alias."</loc>\n";
                    $xmlStr .= "<priority>0.8</priority>\n";
                    $xmlStr .= "</url>\n";
                    $xmlStr .= "<url>\n";
                    $xmlStr .= "<loc>" . $homeUrl . "ua/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "/" . $product->alias ."</loc>\n";
                    $xmlStr .= "<priority>0.8</priority>\n";
                    $xmlStr .= "</url>\n";
//                    $xmlStr .= "<url>\n";
//                    $xmlStr .= "<loc>" . $homeUrl . "en/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "/" . $product->alias ."</loc>\n";
//                    $xmlStr .= "<priority>0.8</priority>\n";
//                    $xmlStr .= "</url>\n";
                }
            }
        }

        $xmlStr .= "</urlset>";

        file_put_contents('sitemap.xml', $xmlStr);
    }

    public function actionCreateReg()
    {
        /*Site map for regional cities*/
        $homeUrl = \Yii::$app->params['homeUrl'];
        $cities = Cities::find()->where(['status'=>1,'is_default'=>0])->all();
        $rootCategories = ProductsCategories::getCategoriesRoots();
        $xmlStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xmlStr .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        foreach ($cities as $city) {
            /*Home pages*/
            $xmlStr .= "<url>\n";
            $xmlStr .= "<loc>" . $homeUrl . $city->alias."</loc>\n";
            $xmlStr .= "<priority>1</priority>\n";
            $xmlStr .= "</url>\n";
            $xmlStr .= "<url>\n";
            $xmlStr .= "<loc>" . $homeUrl . "ua/" . $city->alias . "</loc>\n";
            $xmlStr .= "<priority>1</priority>\n";
            $xmlStr .= "</url>\n";
//            $xmlStr .= "<url>\n";
//            $xmlStr .= "<loc>" . $homeUrl . "en/" . $city->alias . "</loc>\n";
//            $xmlStr .= "<priority>1</priority>\n";
//            $xmlStr .= "</url>\n";

            /*Catalog categories, subcategories, goods*/
//            $xmlStr .= "<url>\n";
//            $xmlStr .= "<loc>" . $homeUrl . "ru/" . $city->alias . "/catalog</loc>\n";
//            $xmlStr .= "<priority>1</priority>\n";
//            $xmlStr .= "</url>\n";
//            $xmlStr .= "<url>\n";
//            $xmlStr .= "<loc>" . $homeUrl . "ua/" . $city->alias . "/catalog</loc>\n";
//            $xmlStr .= "<priority>1</priority>\n";
//            $xmlStr .= "</url>\n";
//            $xmlStr .= "<url>\n";
//            $xmlStr .= "<loc>" . $homeUrl . "en/" . $city->alias . "/catalog</loc>\n";
//            $xmlStr .= "<priority>1</priority>\n";
//            $xmlStr .= "</url>\n";
            foreach ($rootCategories as $rootCategory) {
                $xmlStr .= "<url>\n";
                $xmlStr .= "<loc>" . $homeUrl . $city->alias . "/catalog/".$rootCategory->alias."</loc>\n";
                $xmlStr .= "<priority>0.8</priority>\n";
                $xmlStr .= "</url>\n";
                $xmlStr .= "<url>\n";
                $xmlStr .= "<loc>" . $homeUrl . "ua/" . $city->alias . "/catalog/".$rootCategory->alias."</loc>\n";
                $xmlStr .= "<priority>0.8</priority>\n";
                $xmlStr .= "</url>\n";
//                $xmlStr .= "<url>\n";
//                $xmlStr .= "<loc>" . $homeUrl . "en/" . $city->alias . "/catalog/".$rootCategory->alias."</loc>\n";
//                $xmlStr .= "<priority>0.8</priority>\n";
//                $xmlStr .= "</url>\n";
                $allSubcategories = ProductsCategories::getCategoriesChildren($rootCategory);
                foreach ($allSubcategories as $subcategory) {
                    $xmlStr .= "<url>\n";
                    $xmlStr .= "<loc>" . $homeUrl . $city->alias . "/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "</loc>\n";
                    $xmlStr .= "<priority>0.8</priority>\n";
                    $xmlStr .= "</url>\n";
                    $xmlStr .= "<url>\n";
                    $xmlStr .= "<loc>" . $homeUrl . "ua/" . $city->alias . "/catalog/". $rootCategory->alias . "/" . $subcategory->alias . "</loc>\n";
                    $xmlStr .= "<priority>0.8</priority>\n";
                    $xmlStr .= "</url>\n";
//                    $xmlStr .= "<url>\n";
//                    $xmlStr .= "<loc>" . $homeUrl . "en/" . $city->alias . "/catalog/". $rootCategory->alias . "/" . $subcategory->alias . "</loc>\n";
//                    $xmlStr .= "<priority>0.8</priority>\n";
//                    $xmlStr .= "</url>\n";
                    $products = $subcategory->products;
                    foreach ($products as $product) {
                        $xmlStr .= "<url>\n";
                        $xmlStr .= "<loc>" . $homeUrl . $city->alias . "/catalog/". $rootCategory->alias . "/" . $subcategory->alias . "/" . $product->alias . "</loc>\n";
                        $xmlStr .= "<priority>0.8</priority>\n";
                        $xmlStr .= "</url>\n";
                        $xmlStr .= "<url>\n";
                        $xmlStr .= "<loc>" . $homeUrl . "ua/" . $city->alias . "/catalog/" . $rootCategory->alias . "/" . $subcategory->alias . "/" . $product->alias . "</loc>\n";
                        $xmlStr .= "<priority>0.8</priority>\n";
                        $xmlStr .= "</url>\n";
//                        $xmlStr .= "<url>\n";
//                        $xmlStr .= "<loc>" . $homeUrl . "en/" . $city->alias . "/catalog/". $rootCategory->alias . "/" . $subcategory->alias . "/" . $product->alias . "</loc>\n";
//                        $xmlStr .= "<priority>0.8</priority>\n";
//                        $xmlStr .= "</url>\n";
                    }
                }
            }
        }



        $xmlStr .= "</urlset>";

        file_put_contents('rsitemap.xml', $xmlStr);
    }
}