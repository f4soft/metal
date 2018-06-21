<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use app\components\SluggableBehavior;
use yii\db\ActiveRecord;
use app\models\BaseQuery;
use yii\web\UploadedFile;

class BaseModel extends ActiveRecord
{
    static $lang;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'in_attribute' => 'title_ru',
                'out_attribute' => 'alias',
                'translit' => true,
            ],
            TimestampBehavior::className(),
        ];
    }

    public function init()
    {
        self::$lang = \Yii::$app->params['langs'][\Yii::$app->language];
        parent::init();
    }

    public static function getTranslate($field)
    {
        return $field . "_" . self::$lang;
    }

    public function getImageUrl($preset, $tableName, $field = 'image')
    {
        $imageModel = new ImageUpload($tableName);
        return $imageModel->getImage($this, $preset, 'view', $field);
    }

    /**
     * Get city method
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getNewsSubscriber()
    {
        return $this->hasOne(NewsSubcribers::className(), ['id' => 'news_subscriber_id']);
    }

    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['id' => 'poll_id']);
    }

    public function getOffice()
    {
        return $this->hasOne(Offices::className(), ['id' => 'office_id']);
    }
    public function getOfficesByCity()
    {
        return $this->hasMany(Offices::className(), ['city_id' => 'id']);
//        return $this->hasMany(Offices::className(), ['city_id' => 'id'])->onCondition(['active' => 1]);

    }

    public function getNewsToken()
    {
        return $this->hasMany(NewsToken::className(), ['news_subscriber_id' => 'id']);
    }

    public static function find()
    {
        $activeQuery = new BaseQuery(get_called_class());
        return $activeQuery;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['office_id' => 'id'])->andWhere(['status' => 1]);
    }

    public function getProductCategory()
    {
        return $this->hasOne(ProductsCategories::className(), ["id" => "category_id"]);
    }

    public function getProductRelatedData()
    {
        return $this->hasMany(ProductsPricesToCities::className(), ['product_id' => 'id']);
    }

    public function getProducts()
    {
        $lang = \Yii::$app->language;
        switch ($lang){
            case "ua" : $lg = "ua"; break;
            case "en" : $lg = "en"; break;
            case "ru" : $lg = "ru"; break;
            default : $lg = "ru"; break;                
        }
       
        return $this->hasMany(Products::className(), ['category_id' => 'id'])->onCondition(['not', ['updated_at' => null]])->orderBy(['products.title_'.$lg => SORT_ASC]);
    }
    
    public function getProductsale()
    {
        return $this->hasMany(Products::className(), ['category_id' => 'id'])->andOnCondition(['stock' => 1]);
    }
    
    public function getCityProducts()
    {
        return $this->hasMany(ProductsPricesToCities::className(), ['product_id' => 'id'])->andWhere(['city_id' => $this->city_id]);
    }
    
    public function getCategoriesLink()
    {
        return $this->hasMany(CategoriesLink::className(), ['owner_category_id' => 'id']);
    }
    
    public function getCategoriesLinkForShow()
    {
        return $this->hasMany(CategoriesLink::className(), ['owner_category_id' => 'id'])->andWhere(['status' => 1]);
    }
    
    public function getOwnerCategory()
    {
        return $this->hasOne(ProductsCategories::className(), ["id" => "owner_category_id"]);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getAll()
    {
        return self::find()->getActive()->orderBy('id ASC')->all();
    }

    public function sendEmail($from, $to, $subject, $message) {
        return \Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($message)
            ->send();
    }

    public function sendEmailWithAttach($from, $to, $subject, $message, UploadedFile $file) {
        if(!is_dir(\Yii::getAlias('@webroot') . '/uploads/emailattachments/')) {
            mkdir(\Yii::getAlias('@webroot') . '/uploads/emailattachments/', 0777, true);
        }
        $filePath = \Yii::getAlias('@webroot') . "/uploads/emailattachments/{$file->baseName}.{$file->extension}" ;
        $file->saveAs($filePath);
        return \Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($message)
            ->attach($filePath)
            ->send();
    }

    public static function getNextOrPrevId($currentId, $nextOrPrev)
    {
        $records = NULL;
        if($nextOrPrev == "prev")
            $order="id DESC";
        if($nextOrPrev == "next")
            $order="id ASC";

        $records = self::find()->getActive()->orderBy($order)->all();

        foreach($records as $i=>$r)
            if($r->id == $currentId)
                return isset($records[$i+1]->id) ? $records[$i+1]->alias : $records[0]->alias;

        return NULL;
    }

    static public function getLastRow()
    {
        return self::find()->orderBy('id DESC')->asArray()->one();
    }
}
