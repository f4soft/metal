<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "reports".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $file
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Reports extends BaseModel
{
    public $title;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'pdf, xls, xlsx', 'maxSize' => Yii::$app->params['maxSize']],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),

            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),

            'file' => Yii::t('app/admin', 'Файл'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        parent::afterFind();
    }

    public function upload($fileModel)
    {
        if(!is_dir("uploads/reports")){
            mkdir("uploads/reports", 0777, true);
        }
        if ($this->validate()) {
            $fileName = str_replace(' ', '_', $fileModel->baseName);
            $this->file->saveAs(Yii::getAlias('@webroot') . "/uploads/reports/" . "$fileName.{$fileModel->extension}");
            return true;
        } else {
            return false;
        }
    }

    public function getUploadedFilePath($model)
    {
        if(!$model->file) {
            return false;
        }
        return "/uploads/reports/" . "{$model->file}";
    }
}
