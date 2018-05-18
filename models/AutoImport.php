<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "auto_report".
 *
 * @property integer $id 
 * @property string $file_name
 * @property string $file_type 
 * @property string $error_text
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class AutoImport extends BaseModel
{
    
    /*** file_type ***
     *  
     * - product_group
     * - product
     */    
    
//    public $title;
//    public $cat_description;
//    public $sub_cat_description;
//    public $product_description;
    
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
        return 'auto_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['file_name', 'file_type'], 'string', 'max' => 255],
            [['error_text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'file_name' => Yii::t('app/admin', 'Файл'),
            'file_type' => Yii::t('app/admin', 'Тип'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Обновлен'),
            'created_at' => Yii::t('app/admin', 'Создан'),
        ];
    }

    public function getAllStatus()
    {        
        $arr = [
            1 => 'Ожидает загрузки',
            2 => 'Загружен',            
            3 => 'Парсинг',
            4 => 'Готов',
        ];
        
        return $arr;
    }
    
    public function getStatus()
    {        
        $arr = $this->getAllStatus();
        
        return isset($arr[$this->status]) ? $arr[$this->status] : "";
    }

//    public function afterFind()
//    {
//        $this->title = $this->{self::getTranslate('title')};
//        $this->cat_description = $this->{self::getTranslate('cat_description')};
//        $this->sub_cat_description = $this->{self::getTranslate('sub_cat_description')};
//        $this->product_description = $this->{self::getTranslate('product_description')};
//        parent::afterFind();
//    }

//    static public function getByAlias($alias)
//    {        
//        return self::findOne(['alias' => $alias]);
//    }
//    
//    static public function getByAliasOrKiev($alias)
//    {        
//        $alias = $alias ? $alias : "kiev";
//        
//        return self::findOne(['alias' => $alias]);
//    }
//
//    static public function getDefaultCity()
//    {
//        return self::findOne(['is_default' => 1,'status'=>1]);
//    }
}

