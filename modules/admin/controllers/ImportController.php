<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 11/15/16
 * Time: 11:28 AM
 */

namespace app\modules\admin\controllers;

use app\models\Cities;
use app\models\Products;
use app\models\ProductsCategories;
use app\models\ProductsPricesToCities;
use app\models\ImportUpload;
use yii\web\UploadedFile;
use light\yii2\XmlParser;
use Yii;
use app\modules\admin\components\AppController;

set_time_limit(700);
ini_set('memory_limit', '1028M');

class ImportController extends AppController
{
    const FILE_CITY = 'cities.xml';
    const FILE_CATEGORIES = 'product_group.xml';
    const FILE_PRODUCTS = 'product.xml';

    public function actionIndex()
    {
        return $this->render('index', ['model'=>new ImportUpload()]);
    }

    public function actionImportCities()
    {
        $model = new ImportUpload();
        if (Yii::$app->request->isPost) {
            $model->cities = UploadedFile::getInstance($model, 'cities');
            if ($model->uploadCities()) {
                $file = Yii::getAlias('@app') . "/xml/" . self::FILE_CITY;
                $content = file_get_contents($file);
                $parser = new XmlParser();

                $content = $parser->parse($content, '');
                if (!empty($content['city']) && is_array($content['city']) && count($content['city'])) {
                    $content = reset($content);
                    foreach ($content as $city) {
                        $cityModel = Cities::find()->where(['external_id' => $city['id']])->one();
                        $model = $cityModel ? $cityModel : new Cities();
                        $model->attributes = $city;
                        $model->external_id = !$model->external_id ? $city['id'] : $model->external_id;
                        if (!$cityModel) {
                            $model->status = 1;
                        }

                        if ($model->title_ru == 'Киев') {
                            $model->is_default = 1;
                            $model->alias = 'kiev';
                        }
                        if ($model->title_ru == 'Днепр') {
                            $model->alias = 'dnepr';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Харьков') {
                            $model->alias = 'kharkov';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Львов') {
                            $model->alias = 'lvov';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Винница') {
                            $model->alias = 'vinnitsa';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Одесса') {
                            $model->alias = 'odessa';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Хмельницкий') {
                            $model->alias = 'khmelnytskyi';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Чернигов') {
                            $model->alias = 'chernihiv';
                            $model->is_default = 0;
                        }
                        if ($model->title_ru == 'Полтава') {
                            $model->alias = 'poltava';
                            $model->is_default = 0;
                        }
                        $model->save();
                    }
                    Yii::$app->session->setFlash('success', "Импорт городов прошел успешно!");
                } else {
                    Yii::$app->session->setFlash('danger', "Неверный формат файла для загрузки городов!");
                }

            } else {
                Yii::$app->session->setFlash('danger', "Ошибка загрузки файла городов!");
            }
        } else {
            Yii::$app->session->setFlash('danger', "Ошибка загрузки файла городов!");
        }
        return $this->redirect('/admin/import');
    }

    public function actionImportCategories()
    {
        $model = new ImportUpload();
        if (Yii::$app->request->isPost) {
            $model->categories = UploadedFile::getInstance($model, 'categories');
            if ($model->uploadCategories()) {
                $file = Yii::getAlias('@app') . "/xml/" . self::FILE_CATEGORIES;
                $content = file_get_contents($file);
                $parser = new XmlParser();

                $content = $parser->parse($content, '');              
                if (!empty($content['category'])&& is_array($content['category'])&& count($content['category']) ) {
                    $content = reset($content);

                    foreach ($content as $category) {
                        $current = ProductsCategories::find()->where(['external_id' => $category['external_id']])->one();
                        $model = $current ? $current : new ProductsCategories();
                        $model->attributes = $category;

                        $root = !empty($category['parent_id']) ? ProductsCategories::find()->where("external_id =:external_id", [':external_id' => $category['parent_id']])->one() : ProductsCategories::find()->where("alias =:alias", [':alias' => 'menu'])->one();
                        if (!$current) {
                            $model->status = 1;
                        }
                        
                        if(!$root && !empty($category['parent_id'])){
                            throw new \yii\base\ErrorException('ProductCategoty not found by parent_id '.$category['parent_id']);
                        }
                        
                        $model->appendTo($root, false);

                    }

                    foreach ($content as $category) {
                        $current = ProductsCategories::find()->where(['external_id' => $category['external_id']])->one();
                        $model = $current ? $current : new ProductsCategories();
                        if (isset($category['related_categories']['related_category']) &&
                            is_array($category['related_categories']['related_category']) && !empty($category['related_categories']['related_category'])
                        ) {
                            foreach ($category['related_categories']['related_category'] as $cat) {
                                $relCat = ProductsCategories::find()->where(['external_id' => $cat])->one();
                                if ($relCat) {
                                    $model->related_categories_id .= "{$relCat->id};";
                                }
                            }
                        }
                        $root = !empty($category['parent_id']) ? ProductsCategories::find()->where("external_id =:external_id", [':external_id' => $category['parent_id']])->one() : ProductsCategories::find()->where("alias =:alias", [':alias' => 'menu'])->one();
                        $model->appendTo($root);
                    }
                    Yii::$app->session->setFlash('success', "Импорт категорий прошел успешно!");
                } else {
                    Yii::$app->session->setFlash('danger', "Неверный формат файла для загрузки категорий!");
                }
            } else {
                Yii::$app->session->setFlash('danger', "Ошибка загрузки файла категорий!");
            }
        } else {
            Yii::$app->session->setFlash('danger', "Ошибка загрузки файла категорий!");
        }
        return $this->redirect('/admin/import');
    }


    public function actionImportProducts()
    {        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        
        $request = Yii::$app->request;

        if ($request->isPost) {

                $file = $request->post('file');
                libxml_use_internal_errors(true);
                $xml = simplexml_load_file($file);
                if ($xml) {
                    $products = $xml->xpath('/products/product');
                    
                    $key_all = count($products) - 1;
                    $key_start = $request->post('key_start');
                    $key_end = $key_start + 100;
                    $key_end = $key_end < $key_all ? $key_end : $key_all;
                    $key_next_iteration = $key_end + 1;
                    $need_next_iteration = $key_next_iteration < $key_all ? true : false; 
                    
                    if($key_start == 0){
                        Products::updateAll(['updated_at' => NULL], []);
                        ProductsPricesToCities::updateAll(['updated_at' => NULL], []);                        
                    }
                    
                    if ($products && is_array($products) && count($products)) {
                        for($key_start; $key_start <= $key_end; $key_start ++) {
                            
                            $product = $products[$key_start];                            
                            //\yii\helpers\VarDumper::dump($product); exit();

                            $category = ProductsCategories::find()->where(['external_id' => (string)$product->category_id[0]])->one();
                            $current = Products::find()->where(['external_id' => (string)$product->external_id[0]])->one();
                            $model = $current ? $current : new Products();

                            if(!$category){
                                throw new \yii\base\ErrorException('Categoty not found by external_id '.(string)$product->category_id[0]);
                            }
                            $model->category_id = $category->id;

                            $model->title_ru = !empty($product->title_ru) ? (string)$product->title_ru[0] : '';
                            $model->title_ua = !empty($product->title_ua) ? (string)$product->title_ua[0] : '';
                            $model->title_en = !empty($product->title_en) ? (string)$product->title_en[0] : '';

                            $model->external_id = !empty($product->external_id) ? (string)$product->external_id[0] : '';
                            $model->sku = !empty($product->sku) ? (string)$product->sku[0] : '';
                            $model->cut_price = !empty($product->cut_price) ? (string)$product->cut_price[0] : '';
                            $model->unit = !empty($product->unit) ? $product->unit->__toString() : '';
                            switch ($product->unit->__toString()) {
                                case 'кг':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'kg';
                                    break;
                                case 'компл':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'kompl';
                                    break;
                                case 'м':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'm';
                                    break;
                                case 'м2':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'm2';
                                    break;
                                case 'пач':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'pachka';
                                    break;
                                case 'рул':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'rulon';
                                    break;
                                case 'т':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 't';
                                    break;
                                case 'шт':
                                    $model->unit = $product->unit->__toString();
                                    $model->unit_key = 'sht';
                                    break;
                            }

                            $model->diameter = !empty($product->diameter) ? (string)$product->diameter[0] : '';
                            $model->length = !empty($product->length) ? (string)$product->length[0] : '';
                            $model->width = !empty($product->width) ? (string)$product->width[0] : '';
                            $model->depth = !empty($product->depth) ? (string)$product->depth[0] : '';
                            $model->aisi = !empty($product->aisi) ? (string)$product->aisi[0] : '';
                            /*$model->image = !empty($product->image) ? (string) $product->image[0] : '';*/

                            if (!$current) {
                                $model->status = 1;
                            }
                            
                            $model->stock = $product->action == 1 ? 1 : 0; /* set as special offers (or not) */

                            $model->save();
                            if (!isset($current->id)) {
                                $current = Products::find()->where(['external_id' => (string)$product->external_id[0]])->one();
                                $current = $current ?: new Products();
                            }
                            /**
                             * prices
                             */
                            if (!empty($product->prices)) {
                                foreach ($product->prices->price as $key => $price) {
                                    $cityID = $price->attributes()->city_id->__toString();                                    
                                    $cityID = Cities::find()->where(['external_id' => $cityID])->one();
                                    if ($cityID && $current) {
                                        $modelPrice = ProductsPricesToCities::find()->where(['city_id' => $cityID->id, 'product_id' => $current->id])->one() ?: new ProductsPricesToCities();
                                    } else {
                                        $modelPrice = new ProductsPricesToCities();
                                    }
                                    
                                    if(!$cityID){
                                        throw new \yii\base\ErrorException('City not found by external_id '.(string)$price->attributes()->city_id->__toString());
                                    }
                                    
                                    $modelPrice->city_id = $cityID->id;
                                    $modelPrice->product_id = $current->id;
                                    $modelPrice->price = $price->__toString();
                                    $modelPrice->save();
                                    
                                    unset($modelPrice);
                                }
                            }

                            if (!empty($product->coefficients)) {
                                foreach ($product->coefficients->coefficient as $key => $coefficient) {
                                    $cityID = $coefficient->attributes()->city_id->__toString();
                                    $cityID = Cities::find()->where(['external_id' => $cityID])->one();
                                    if ($cityID && $current) {
                                        $modelCoefficient = ProductsPricesToCities::find()->where(['city_id' => $cityID->id, 'product_id' => $model->id])->one();
                                    } else {
                                        $modelCoefficient = new ProductsPricesToCities();
                                    }
                                    $modelCoefficient->city_id = $cityID->id;
                                    $modelCoefficient->product_id = $current->id;
                                    $modelCoefficient->coefficient = $coefficient->__toString();
                                    $modelCoefficient->coefficient = str_replace(',', '.', $modelCoefficient->coefficient);
                                    $modelCoefficient->update();
                                    
                                    unset($modelCoefficient);
                                }
                            }

                            if (!empty($product->descriptions)) {
                                foreach ($product->descriptions->description as $key => $description) {
                                    $cityID = $description->attributes()->city_id->__toString();
                                    $cityID = Cities::find()->where(['external_id' => $cityID])->one();
                                    if ($cityID && $current) {
                                        $modelDescription = ProductsPricesToCities::find()->where(['city_id' => $cityID->id, 'product_id' => $model->id])->one();
                                    } else {
                                        $modelDescription = new ProductsPricesToCities();
                                    }
                                    $modelDescription->city_id = $cityID->id;
                                    $modelDescription->product_id = $current->id;
                                    $modelDescription->description_ru = $modelDescription->description_ua = $modelDescription->description_en = $description->__toString();
                                    $modelDescription->update();
                                    
                                    unset($modelDescription);
                                }
                            }
                            
                            unset($model);
                            
                            if($need_next_iteration == false){
                                Products::deleteAll(['updated_at' => NULL]);
                                ProductsPricesToCities::deleteAll(['updated_at' => NULL]); 
                            }
                        }
                        
                        return [                            
                            'next_iter' => $need_next_iteration,
                            'key_all' => $key_all,
                            'key_start' => $key_next_iteration,
                            'message' => null,                            
                        ];                        

                    }
                } else {                    
                    return ['message' => "Неверный формат файла для загрузки товаров!"];
                }
        } else {            
            return ['message' => "Ошибка загрузки файла товаров!"];        
        }
    }
    
    public function actionUploadProducts()
    {        
        $result = [
            'file' => null,
            'message' => null,
            'status' => 0,
        ];
        
        $model = new ImportUpload();
        if (Yii::$app->request->isPost) {
            $model->products = UploadedFile::getInstance($model, 'products');       
            if ($model->uploadProducts()) {
                $result['file'] = Yii::getAlias('@app') . "/xml/" . self::FILE_PRODUCTS;
                $result['status'] = 3;
                $result['message'] = 'File has been uploaded. Please wait, parsing will be processing to 10 minutes.';
            } else {
                $result['status'] = 2;
                $result['message'] = 'File has not been uploaded. Something wrong.';
            }            
        } else {
            $result['status'] = 1;
            $result['message'] = 'Something wrong. Please try again later.';
        }
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
                
        return $result;        
    }
}