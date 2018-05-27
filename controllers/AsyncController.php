<?php
namespace app\controllers;

use app\components\AppController;
use app\models\AutoImport;

use Yii;
use yii\web\Response;

use Exception;
use PDOException;

class AsyncController extends AppController
{
    public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
        
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
}

