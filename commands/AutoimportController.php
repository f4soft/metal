<?php

namespace app\commands;

use Yii;
use app\components\Helper;
use yii\console\Controller;
use yii\db\Query;
use Exception;
use PDOException;

use light\yii2\XmlParser;
use app\models\BaseModel;
use app\models\Error404;
use app\models\AutoImport as modelAutoImport;
use app\models\Cities;
use app\models\Products;
use app\models\ProductsCategories;
use app\models\ProductsPricesToCities;

class AutoimportController extends Controller
{ 
    
    public function __construct($id, $module, $config = array()) {
        
        parent::__construct($id, $module, $config);
                
        Yii::$app->i18n->translations['app*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'app' => 'app.php',
                'app/admin' => 'admin.php',
                'app/units' => 'units.php'
            ],
        ];
    }
    
    public function actionIndex()
    {

    }
    
    public function actionCategories()
    {        
        $dataAuto = modelAutoImport::find()
                ->where(['status' => 2])
                ->andWhere(['file_type' => 'products_categories'])
                ->andWhere(['IS', 'error_text', null])
                ->orderBy('created_at ASC')
                ->one();    

        if ($dataAuto){
            
            $file = Yii::getAlias('@app') . "/xml/load_from_1c/" . $dataAuto->file_name;            
            if (file_exists($file)) {
                
                $dataAuto->status = 3;
                $dataAuto->save();           
                
                $content = file_get_contents($file);
                $parser = new XmlParser();

                $content = $parser->parse($content, '');              
                if (!empty($content['category'])&& is_array($content['category'])&& count($content['category']) ) {
                    
                    try {
                    
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
                    
                    $dataAuto->status = 4;
                    $dataAuto->save();
                
                    var_dump('Category import has been success !');
                    
                    } catch (PDOException $e) {
                        $dataAuto->error_text = $e->getMessage();
                        $dataAuto->save();

                        var_dump($e->getMessage());
                        
                    } catch (Exception $e) {
                        $dataAuto->error_text = $e->getMessage();
                        $dataAuto->save();

                        var_dump($e->getMessage());
                    }
                    
                } else {                    
                    $dataAuto->error_text = "Eror: wrong file format!";
                    $dataAuto->save();
                    
                    throw new Exception("Eror: wrong file format!");
                }
            } else {                
                $dataAuto->error_text = "Error: file not exist!";
                $dataAuto->save();
                
                throw new Exception("Error: file not exist!");
            }
        } else {
            var_dump('No data for import');
        }        
    }
    
    
    public function actionProducts()
    {
        $dataAuto = modelAutoImport::find()
                ->where(['status' => 2])
                ->andWhere(['file_type' => 'products'])
                ->andWhere(['IS', 'error_text', null])
                ->orderBy('created_at ASC')
                ->one();
        
        if ($dataAuto){

            $file = Yii::getAlias('@app') . "/xml/load_from_1c/" . $dataAuto->file_name; 
            if (file_exists($file)) {
                
                $dataAuto->status = 3;
                $dataAuto->save();
                
                libxml_use_internal_errors(true);
                $xml = simplexml_load_file($file);
                if ($xml) {                  
                    
                    $products = $xml->xpath('/products/product');
                    $key_all = count($products) - 1;
                    $key_sleep = 100; 
                    
                    if($key_all){
                        var_dump('previos update');
                        Products::updateAll(['updated_at' => NULL], []);
                        ProductsPricesToCities::updateAll(['updated_at' => NULL], []);                        
                    }

                    if ($products && is_array($products) && count($products)) {                       
                        
                        try {

                            foreach($products as $key_product => $product) {

                                $need_next_iteration = isset($products[$key_product + 1]) ? true : false;                       

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

                                if(empty($key_sleep) && $need_next_iteration){
                                    $key_sleep = 100;
                                    var_dump("sleep 10 sec");
                                    sleep(10);                               
                                }                            
                                $key_sleep --;
                            }

                            if($key_all){
                                var_dump('previos delete');
                                Products::deleteAll(['updated_at' => NULL]);
                                ProductsPricesToCities::deleteAll(['updated_at' => NULL]); 
                            }

                            $dataAuto->status = 4;
                            $dataAuto->save();

                            var_dump('Product import has been success !');   

                        } catch (PDOException $e) {
                            $dataAuto->error_text = $e->getMessage();
                            $dataAuto->save();
                            
                            var_dump($e->getMessage()); 

                        } catch (Exception $e) {
                            $dataAuto->error_text = $e->getMessage();
                            $dataAuto->save();
                            
                            var_dump($e->getMessage());
                        }
                    }
                } else {                   
                    $dataAuto->error_text = "Eror: wrong file format!";
                    $dataAuto->save();
                    
                    throw new Exception("Eror: wrong file format!");
                }
            } else {                  
                $dataAuto->error_text = "Error: file not exist!";
                $dataAuto->save();
                
                throw new Exception("Error: file not exist!");    
            }
        
        } else {
            var_dump('No data for import');
        } 
    }
}
