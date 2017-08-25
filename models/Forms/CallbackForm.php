<?php

namespace app\models\Forms;

use Yii;
use app\models\BaseModel;

class CallbackForm extends BaseModel
{
    public $name;
    public $phone;
    public $email;
    public $time;
    public $note;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['email'], 'email', 'message' => Yii::t('app', 'Неправильный «Email»')],
            [['phone','message'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => '',
            'name' => 'nAME',
            'phone' => '',
            'time' => '',
            'message' => '',
        ];
//        return [
//            'email' => Yii::t('app', 'Ваш Email..'),
//            'name' => Yii::t('app', 'Ваше имя...'),
//            'phone' => Yii::t('app', 'Номер телефона..'),
//            'time' => Yii::t('app', 'Удобное для звонка время'),
//            'message' => Yii::t('app', 'Примечание'),
//        ];
    }

    public function messages()
    {

    }

}