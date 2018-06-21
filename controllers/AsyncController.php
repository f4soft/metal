<?php
namespace app\controllers;

use app\components\AppController;
use app\models\AutoImport;
use app\models\ProductsCategories;
use app\models\Cities;

use Yii;
use yii\web\Response;

use Exception;
use PDOException;

class AsyncController extends AppController
{
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        $model = new \app\models\Products();
        
        $model->title_ru = "Алюм. круг 10 2024 T3";
        $model->title_ua = "Алум. круг 10 2024 T3";
        $model->category_id = 777;
        
        $model->validate();
        
        var_dump($model->alias); exit();
    }
    
    public function actionReport()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $headers = Yii::$app->request->headers;
        $post = Yii::$app->request->post();    
        
        $accessToken = $headers->get('Metal-Auth');
        
        if($accessToken == "b640a0ce465fa2a4150c36b305c1c11b"){
       
            try{           
                
                $exist = AutoImport::findOne(["file_name"=>$post['file_name']]);
                if($exist){            
                    $exist->status = $post['status'];
                    $exist->save(); 
                    $case = 'updated';     
                } else {
                    $model = new AutoImport();
                    $model->file_name = $post['file_name'];
                    $model->file_type = $post['file_type'];
                    $model->status = $post['status'];            
                    $model->save();
                    $case = 'created';     
                }
                
                return ['success' => 'ok', 'message' => 'data has been '.$case]; 
                
            } catch (PDOException $e) {
                return ['success' => 'error', 'message' => $e->getMessage()];    
            } catch (Exception $e) {
                return ['success' => 'error', 'message' => $e->getMessage()];   
            }
        
        } else {
            return ['success' => 'error', 'message' => 'auth credential is failed'];    
        }       
    }
    
    public function actionPdf()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $headers = Yii::$app->request->headers;
        $post = Yii::$app->request->post();    
        
        $accessToken = $headers->get('Metal-Auth');
        
        if($accessToken == "b640a0ce465fa2a4150c36b305c1c11b"){
            
            try {
            
                $city = Cities::find()->where(['external_id' => $post['city_id']])->one();  
                $model = ProductsCategories::find()->where(['external_id' => $post['external_id']])->one();        
                if($model && $city){

                    $file = Yii::getAlias('@app') . "/xml/load_from_1c/" . $post['file_name'];  
                    if (file_exists($file)) {

                        $path = Yii::getAlias('@app') . "/www/uploads/prices/{$model->id}";
                        if(!is_dir($path)){
                            mkdir($path, 0777, true);
                        }                  
 
                        $file_result = copy($file, $path . "/" . $post['file_name']);                       
                        if($file_result){

                            switch($post['lang']){
                                case "ru" : $lang = "ru"; break;
                                case "ua" : $lang = "ua"; break;
                                case "en" : $lang = "en"; break;
                                default : 
                                    return ['success' => 'error', 'message' => 'Invalid lang parameter']; 
                                    break;
                            }
                            
                            if($city->alias == "kiev"){
                                $file_price = "file_price_$lang";
                            } else {                                
                                $file_price = "file_price_" . $city->alias . "_" . $lang;
                            }
                            
                            $model->{$file_price} = $post['file_name'];

                            $model->save();
                            @unlink($file);

                            return ['success' => 'ok', 'message' => 'data has been updated']; 

                        } else {
                            @unlink($file);
                            return ['success' => 'error', 'message' => 'Operation move file return false']; 
                        }

                    } else {
                        return ['success' => 'error', 'message' => 'File not exist']; 
                    }
                } else {                
                    return ['success' => 'error', 'message' => 'External_id not exist']; 
                }

            } catch (PDOException $e) {
                return ['success' => 'error', 'message' => $e->getMessage()];                            
            } catch (Exception $e) {
                return ['success' => 'error', 'message' => $e->getMessage()];  
            }
        
        } else {
            return ['success' => 'error', 'message' => 'auth credential is failed'];    
        }       
    }
}

