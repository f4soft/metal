<?php

namespace app\models\Forms;

use Yii;
use app\models\BaseModel;

class ContactForm extends BaseModel
{
    public $name;
    public $phone;
    public $email;

    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Имя'),
            'phone' => Yii::t('app', 'Телефон'),
        ];
    }

}