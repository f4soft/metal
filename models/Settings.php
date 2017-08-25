<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $const_name
 */
class Settings extends BaseModel
{
    public function behaviors()
    {
        return[];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'const_name'], 'required'],
            [['name', 'value', 'const_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app/admin', 'Название'),
            'value' => Yii::t('app/admin', 'Значение'),
        ];
    }
}
