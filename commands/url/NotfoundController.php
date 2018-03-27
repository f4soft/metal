<?php

namespace app\commands\url;

use Yii;
use app\components\Helper;
use yii\console\Controller;
use yii\db\Query;

use app\models\BaseModel;
use app\models\Error404;

class NotfoundController extends Controller
{       
    
    public function actionIndex()
    {
        $baseDir = Yii::$app->basePath;
        $file = $baseDir . '/404_error.csv';
        $count = 0;
        
        /* open file */
        if(($handle_f = fopen($file, "r")) !== FALSE){
            
            /* set iteration in file to row numper 0 */
            fseek($handle_f, 0); 
            
            while(($row = fgetcsv($handle_f, 0, ","))!== FALSE){
                
                if(filter_var($row[0], FILTER_VALIDATE_URL) !== false){
                    
                    $count ++;                    
//                    if($count == 507){
//                        var_dump(ftell($handle_f));
//                        exit();
//                    }                
                    
                    $category_alias_404 = null;
                    $category_child_alias_404 = null;
                    $product_alias_404 = null;
                    
                    if(strpos($row[0], 'catalog/') !== false){
                        
                        $tmp = explode("catalog/", $row[0]);
                        $param = explode("/", $tmp[1]);                  

                        $category_alias_404 = $param[0];                            
                        if(isset($param[1])){
                            $category_child_alias_404 = $param[1];
                        }
                        if(isset($param[2])){
                            $product_alias_404 = $param[2];
                        }     
                    }
                                                              
                    $model = new Error404(); 

                    $data = $model->findOne(['url_404' => $row[0]]);                    
                    if($data){                        
                        unset($data);
                        continue;
                    }                    

                    $data = $model;
                    $data->url_404 = $row[0];
                    $data->category_alias_404 = $category_alias_404;
                    $data->category_child_alias_404 = $category_child_alias_404;
                    $data->product_alias_404 = $product_alias_404;
                    $data->status = 1;
                    $data->save();
                    
                }                
            }            
        }       
    }   
    
    public function actionCheckExist()
    {      
        $model = new Error404();
        $data = $model->find()
            ->where(['status' => 1]) 
            ->orderBy('created_at ASC')
            ->limit(100)
            ->all();
      
        if($data){
            foreach($data as $iter){

                $headers = array();
                $result = $this->curlGet($iter->url_404, $headers);

                if($result['http_code'] == 404){
                    $iter->status = 3;
                    $iter->save();
                } else if($result['http_code'] == 200) {
                    $iter->status = 2;
                    $iter->save();
                } 
            }
        }
    }
    
    public function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, false);
        $out = curl_exec($ch);
        
        $out_info = curl_getinfo($ch); 
        
        curl_close($ch);

        return $out_info;
    }

    public function actionCompareOldUrl()
    {
        $model = new Error404();
        $data = $model->find()
            ->where(['status' => 3]) 
            ->orderBy('created_at ASC')
            ->limit(100)
            ->all();
        
        $sqlCategoryOld = "SELECT id, external_id FROM products_categories_v2 WHERE alias = :alias";
        $sqlCategoryNew = "SELECT id, title_ru, alias FROM products_categories WHERE external_id = :external_id AND alias != :alias";
        
        $sqlProductOld = "SELECT id, external_id FROM products_v2 WHERE alias = :alias";
        $sqlProductNew = "SELECT id, title_ru, alias FROM products WHERE external_id = :external_id AND alias != :alias";
        
        foreach($data as $iter){

//            var_dump($iter->url_404);
//            var_dump($iter->category_alias_404);
//            var_dump($iter->category_child_alias_404);
//            var_dump($iter->product_alias_404);
            
            $queryCategoryOld = Yii::$app->db->createCommand($sqlCategoryOld);
            $existCategoryOld = $queryCategoryOld
                    ->bindValues([':alias' => $iter->category_alias_404])
                    ->queryOne();
          
            $queryCategoryChildOld = Yii::$app->db->createCommand($sqlCategoryOld);
            $existCategoryChildOld = $queryCategoryChildOld
                    ->bindValues([':alias' => $iter->category_child_alias_404])
                    ->queryOne();
            
            $queryProductOld = Yii::$app->db->createCommand($sqlProductOld);
            $existProductOld = $queryProductOld
                    ->bindValues([':alias' => $iter->product_alias_404])
                    ->queryOne();

//var_dump($existCategoryOld);
//var_dump($existCategoryChildOld);
//var_dump($existProductOld);
//
//            $queryCategoryNew = Yii::$app->db->createCommand($sqlCategoryNew);
//            $existCategoryNew = $queryCategoryNew
//                    ->bindValues([
//                        ':external_id' => $existCategoryOld['external_id'],
//                        ':alias' => $iter->category_alias_404])
//                    ->queryOne();
//
//            $queryCategoryChildNew = Yii::$app->db->createCommand($sqlCategoryNew);
//            $existCategoryChildNew = $queryCategoryChildNew
//                    ->bindValues([
//                        ':external_id' => $existCategoryChildOld['external_id'],
//                        ':alias' => $iter->category_child_alias_404])
//                    ->queryOne();
//
//var_dump($existCategoryNew);            
//var_dump($existCategoryChildNew);
//exit();
            
            if($existCategoryOld && !$iter->corection_cat){
                
                $queryCategoryNew = Yii::$app->db->createCommand($sqlCategoryNew);
                $existCategoryNew = $queryCategoryNew
                        ->bindValues([
                            ':external_id' => $existCategoryOld['external_id'],
                            ':alias' => $iter->category_alias_404])
                        ->queryOne();
                
                if($existCategoryNew){
                    
                    $iter->category_alias_200 = $existCategoryNew['alias'];
                    $iter->corection_cat = 1;
                    $iter->status = 4;
                    $iter->url_200 = $iter->getCorrectUrl();                    
                    $iter->save();
                    
                    $check = $this->curlGet($iter->url_200, array());
                    if($check['http_code'] == 404){
                        $iter->status = 3;
                        $iter->save();
                    } else if($check['http_code'] == 200) {
                        $iter->status = 2;
                        $iter->save();
                    }
                    
//                    var_dump($iter->url_404);
//                    var_dump($iter->url_200);
//                    var_dump('category_alias ' . $existCategoryNew['alias'] . ' title ' . $existCategoryNew['title_ru']);
//                    var_dump('category_id ' . $existCategoryNew['id']);
//                    var_dump('error_id ' . $iter->id);
//                    var_dump('status ' . $iter->status);
//                    exit();
                
                    continue;
                }              
            }
            if($existCategoryChildOld && !$iter->corection_cat_child){
                
                $queryCategoryChildNew = Yii::$app->db->createCommand($sqlCategoryNew);
                $existCategoryChildNew = $queryCategoryChildNew
                        ->bindValues([
                            ':external_id' => $existCategoryChildOld['external_id'],
                            ':alias' => $iter->category_child_alias_404])
                        ->queryOne();
                
                if($existCategoryChildNew){
                    
                    $iter->category_child_alias_200 = $existCategoryChildNew['alias'];
                    $iter->corection_cat_child = 1;
                    $iter->status = 4;   
                    $iter->url_200 = $iter->getCorrectUrl();  
                    $iter->save();
                    
                    $check = $this->curlGet($iter->url_200, array());
                    if($check['http_code'] == 404){
                        $iter->status = 3;
                        $iter->save();
                    } else if($check['http_code'] == 200) {
                        $iter->status = 2;
                        $iter->save();
                    }
                    
//                    var_dump($iter->url_404);
//                    var_dump($iter->url_200);
//                    var_dump('category_child_alias ' . $existCategoryChildNew['alias'] . ' title ' . $existCategoryChildNew['title_ru']);
//                    var_dump('category_child_id ' . $existCategoryChildNew['id']);
//                    var_dump('error_id ' . $iter->id);
//                    var_dump('status ' . $iter->status);
//                    exit();
                
                    continue;
                }                
            }
            if($existProductOld && !$iter->corection_product){
                
                $queryProductNew = Yii::$app->db->createCommand($sqlProductNew);
                $existProductNew = $queryProductNew
                        ->bindValues([
                            ':external_id' => $existProductOld['external_id'],
                            ':alias' => $iter->product_alias_404])
                        ->queryOne();
                
                if($existProductNew){
                    
                    $iter->product_alias_200 = $existProductNew['alias'];
                    $iter->corection_product = 1;
                    $iter->status = 4;  
                    $iter->url_200 = $iter->getCorrectUrl();  
                    $iter->save();
                    
                    $check = $this->curlGet($iter->url_200, array());
                    if($check['http_code'] == 404){
                        $iter->status = 3;
                        $iter->save();
                    } else if($check['http_code'] == 200) {
                        $iter->status = 2;
                        $iter->save();
                    }                  
                    
//                    var_dump($iter->url_404);
//                    var_dump($iter->url_200);
//                    var_dump('corection_product ' . $existProductNew['alias'] . ' title ' . $existProductNew['title_ru']);
//                    var_dump('product_id ' . $existProductNew['id']);
//                    var_dump('error_id ' . $iter->id);
//                    var_dump('status ' . $iter->status);
//                    exit();
                
                    continue;
                }                
            }
            
            $iter->status = 5;
            $iter->save();            
        }
    }
    
    public function actionUpdateBaseUrl()
    {
        $model = new Error404();
        $query = $model->find()
                ->where(['status' => 2])
                ->andWhere(['not',  ['url_200' => null]])
                ->orderBy('created_at ASC');
        
        $count = 0;
        
        foreach($query->each() as $iter){
            
            if(strpos($iter->url_404, 'catalog/') !== false){                
                
                $tmp404 = explode("catalog/", $iter->url_404);
                $tmp200 = explode("catalog/", $iter->url_200);                              
                
                $iter->url_200 = $tmp404[0] . "catalog/" . $tmp200[1];                
                $iter->save();
                $count ++;                
            }                    
        } 
        
        var_dump('result ' . $count);
    }
    
    public function actionSetRedirect()
    {
        $model = new Error404();
        $query = $model->find()
                ->where(['status' => 2, 'redirect' => null])
                ->andWhere(['not',  ['url_200' => null]])
                ->orderBy('created_at ASC');        
        
        $count = 0;     
        $baseUrl = Yii::$app->params['homeUrl'];
        
        foreach($query->each() as $iter){            
            
            $redirect_from = str_replace($baseUrl, "", $iter->url_404);            
            $iter->redirect = "RedirectMatch 301 ^/" . $redirect_from . "$ " . $iter->url_200;            
            $iter->save();
            $count ++;
        }
        
        var_dump('result ' . $count);
    }
}