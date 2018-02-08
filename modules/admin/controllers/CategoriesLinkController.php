<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AppController;
use Yii;
use yii\web\NotFoundHttpException;

use app\models\ProductsCategories;
use app\models\CategoriesLink;
use app\models\Filters\CategoriesLinkSearch;

/**
 * ProductsLinkController implements the CRUD actions for CategoriesLink model.
 */
class CategoriesLinkController extends AppController
{
    /**
     * Lists all CategoriesLink models.
     * @return mixed
     */
    public function actionIndex($category_id)
    {        
        $modelCategory = new ProductsCategories();
        $category = $modelCategory->findOne(['id' => $category_id]);
        
        if(!$category){
            throw new NotFoundHttpException('The requested product does not exist.');
        }
       
        $searchModel = new CategoriesLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);

        return $this->render('index', [
            'category' => $category,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Creates a new CategoriesLink model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate($category_id)
    {                
        $modelLink = new CategoriesLink();
        $modelCategory = new ProductsCategories();
      
        $category = $modelCategory->findOne(['id' => $category_id]);
        $menuMain = $modelCategory::getCategoriesRoots();
      
        if(!$category){
            throw new NotFoundHttpException('The requested product does not exist.');
        }
                        
        if ($modelLink->load(Yii::$app->request->post())) {
         
            if($modelLink->save()){

                return $this->redirect(['index', 'category_id' => $category->id]);
            } else {
                return $this->render('create', [
                    'menuMain' => $menuMain,
                    'category' => $category,
                    'model' => $modelLink,
                    'dataRequest' => Yii::$app->request->post(), 
                ]);
            }
        } else {
            
            $categoryRoot = $modelCategory::getRootCategory($category->id);
            
            return $this->render('create', [
                'menuMain' => $menuMain,
                'category' => $category,
                'model' => $modelLink,
                'dataRequest' => ['categoryRoot' => $categoryRoot->id], 
            ]);
        }
    }
    
    /**
     * Update a new CategoriesLink model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionUpdate($id)
    {                
        $modelLink = new CategoriesLink();
        $modelCategory = new ProductsCategories();
      
        $link = $modelLink->findOne(['id' => $id]);
        
        if(!$link){
            throw new NotFoundHttpException('The requested link does not exist.');
        }
        
        $category = $modelCategory->findOne(['id' => $link->owner_category_id]);
        $menuMain = $modelCategory::getCategoriesRoots();
      
        if(!$category){
            throw new NotFoundHttpException('The requested product does not exist.');
        }
        
        if ($link->load(Yii::$app->request->post())) {
         
            if($link->save()){

                return $this->redirect(['index', 'category_id' => $category->id]);
            } else {
                return $this->render('update', [
                    'menuMain' => $menuMain,
                    'category' => $category,
                    'model' => $link,
                    'dataRequest' => Yii::$app->request->post(), 
                ]);
            }
        } else {
            
            $categoryRoot = $modelCategory::getRootCategory($link->category_id);
           
            return $this->render('update', [
                'menuMain' => $menuMain,
                'category' => $category,
                'model' => $link,
                'dataRequest' => ['categoryRoot' => $categoryRoot->id], 
            ]);
        }
    }
    
    public function actionDelete($id)
    {
        $modelLink = new CategoriesLink();
        
        $link = $modelLink->findOne(['id' => $id]);
        
        if(!$link){
            throw new NotFoundHttpException('The requested link does not exist.');
        }
        
        $category_id = $link->owner_category_id;
        $link->delete();
                
        return $this->redirect(['index', 'category_id' => $category_id]);
    }
    
    public function actionGetSubCategory()
    {
        if(Yii::$app->request->isAjax){        
            
            $paramPost = Yii::$app->request->post();            
            
            $modelCategory = new ProductsCategories();

            $categoryRoot = $modelCategory->findOne(['id' =>$paramPost['category_id']]);
          
            if(!$categoryRoot){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['code' => 0, 'message' => 'not found category root'];
            }
            
            $categories = $modelCategory::getCategoriesChildren($categoryRoot);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['categories' => $categories, 'code' => 200, 'message' => 'ok'];        
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 0, 'message' => 'not valid request type'];
        }
    }
}

