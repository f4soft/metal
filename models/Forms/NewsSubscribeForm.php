<?php

namespace app\models\Forms;

use Yii;
use app\models\BaseModel;

class NewsSubscribeForm extends BaseModel
{
    public $email;
    public $language;
    public function rules()
    {
        return [
            [['email', 'language'], 'required'],
            [['language'], 'safe'],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'language' => Yii::t('app', 'Язык'),
        ];
    }

}