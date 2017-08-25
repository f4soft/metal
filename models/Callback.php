<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Callback extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
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
            [['message'], 'string'],
            [['status', 'updated_at', 'created_at'], 'integer'],
            [['name', 'email','phone'], 'required', 'message' => Yii::t('app', 'Необходимо заполнить {attribute}')],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app/admin', 'Имя'),
            'phone' => Yii::t('app/admin', 'Телефон'),
            'email' => Yii::t('app/admin', 'Email'),
            'message' => Yii::t('app/admin', 'Сообщение'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }
}
