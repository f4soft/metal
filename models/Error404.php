<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "error_404".
 *
 * @property integer $id
 * @property string $url_404
 * @property string $category_alias_404
 * @property string $product_alias_404
 * @property string $url_200
 * @property string $category_alias_200
 * @property string $product_alias_200
 * @property integer $corection_cat
 * @property integer $corection_cat_child
 * @property integer $corection_product
 * @property integer $status
 * @property text redirect
 * @property integer $updated_at
 * @property integer $created_at
 */
class Error404 extends BaseModel
{
    
    /* status 
     * 1 - new
     * 2 - confirm exist
     * 3 - confirm not exist
     * 4 - compare with old alias (exist)
     * 5 - compare with old alias (not exist)  
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'error_404';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url_404', 'status'], 'required'],
            [['corection_cat', 'corection_cat_child', 'corection_product', 'status', 'updated_at', 'created_at'], 'integer'],
            [['url_404', 'category_alias_404', 'product_alias_404', 'url_200', 'category_alias_200', 'product_alias_200'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url_404' => Yii::t('app/admin', 'Адрес не найденой стараницы'),
            'category_alias_404' => Yii::t('app/admin', 'Алиас категории'),
            'product_alias_404' => Yii::t('app/admin', 'Алиас продукта'),       
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }
    
    public function getCorrectUrl()
    {   
        if(strpos($this->url_404, 'catalog/') !== false){            
            $tmp = explode("catalog/", $this->url_404);             
            $baseUrl = $tmp[0];            
        } else {
            return null;            
        }
        
        $category = $this->category_alias_404;
        $category_child = $this->category_child_alias_404;
        $product = $this->product_alias_404;
        
        if($this->corection_cat){
            $category = $this->category_alias_200;
            if(!$this->category_child_alias_404){
                return $baseUrl . "catalog/" . $category;
            }
        }
        if($this->corection_cat_child){
            $category_child = $this->category_child_alias_200;
            if(!$this->product_alias_404){
                return $baseUrl . "catalog/" . $category . "/" . $category_child;
            }
        }
        if($this->corection_product){
            $product = $this->product_alias_200;
        }
        
        if($this->corection_cat || 
           $this->corection_cat_child || 
           $this->corection_product){
            
            return $baseUrl . "catalog/" . $category . "/" . $category_child . "/" . $product;            
        } else {            
            return null;
        }
    }

}

