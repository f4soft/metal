<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "categories_link".
 *
 * @property integer $id
 * @property integer $owner_category_id
 * @property integer $category_id
 * @property tinyint $status
 * @property integer $updated_at
 * @property integer $created_at
 */

class CategoriesLink extends BaseModel
{    
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
        return 'categories_link';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_category_id', 'category_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['owner_category_id', 'category_id'], 'required'],            
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'owner_category_id' => Yii::t('app/admin', 'Для Категории'),
            'category_id' =>  Yii::t('app/admin', 'Категория'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }
}