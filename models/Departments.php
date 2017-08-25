<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "departments".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $phone
 * @property string $email
 * @property string $leader_fio_ru
 * @property string $leader_fio_ua
 * @property string $leader_fio_en
 * @property integer $office_id
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Departments extends BaseModel
{
    public $title;
    public $leader_fio;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
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
            [['office_id'], 'required'],
            [['office_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['email'], 'email'],
            [['title_ru', 'title_ua', 'title_en', 'phone', 'leader_fio_ru', 'leader_fio_ua', 'leader_fio_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),
            'phone' => Yii::t('app/admin', 'Телефон'),
            'email' => Yii::t('app/admin', 'Email'),
            'leader_fio_ru' => Yii::t('app/admin', 'Начальник отдела'),
            'leader_fio_ua' => Yii::t('app/admin', 'Начальник отдела'),
            'leader_fio_en' => Yii::t('app/admin', 'Начальник отдела'),
            'office_id' => Yii::t('app/admin', 'Филиал'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->leader_fio = $this->{self::getTranslate('leader_fio')};
        parent::afterFind();
    }
}
