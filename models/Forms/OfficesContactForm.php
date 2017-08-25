<?php
namespace app\models\Forms;


use app\models\BaseModel;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;

class OfficesContactForm extends BaseModel
{
    public $name;
    public $phone;
    public $email_from;
    public $email_to;
    public $message;
    public $reCaptcha;

    public function rules()
    {
        return [
            [['email_from'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['name'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['message'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['reCaptcha'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['message'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['phone'], 'string', 'max' => 15],
            [['email_from', 'email_to'], 'email'],
            [['reCaptcha'], ReCaptchaValidator::className(), 'secret' => '6LflPwsUAAAAAJvvqbI3x1cqFZS75RKSGgK1LTKs']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email_from' => Yii::t('app', 'Email'),
            'email_to' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Имя'),
            'phone' => Yii::t('app', 'Телефон'),
            'message' => Yii::t('app', 'Сообщение'),
        ];
    }
}