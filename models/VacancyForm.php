<?php

namespace app\models;
use Yii;

class VacancyForm extends BaseModel
{
    public $fio;
    public $email;
    public $phone;
    public $file;
    public $vacancy_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancies';
    }

    public function behaviors()
    {
        return [

        ];
    }
    public function rules()
    {
        return [
            [['file'],  'safe'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, doc, docx', 'maxSize' => Yii::$app->params['maxSize']],
            [['fio', 'email', 'phone'], 'required'],
            [['fio'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 14],
            ['email', 'email'],
            [['vacancy_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fio' => Yii::t('app/admin', 'ФИО'),
            'email' => Yii::t('app/admin', 'Email'),
            'phone' => Yii::t('app/admin', 'Моб. телефон'),
            'file' => Yii::t('app/admin', 'Резюме'),
        ];
    }
}