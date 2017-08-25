<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $image
 * @property string $image_alt_en
 * @property string $image_alt_ru
 * @property string $image_alt_ua
 * @property string $image_title_en
 * @property string $image_title_ru
 * @property string $image_title_ua
 * @property string $fname_ru
 * @property string $fname_en
 * @property string $fname_ua
 * @property string $lname_ru
 * @property string $lname_en
 * @property string $lname_ua
 * @property string $sname_ru
 * @property string $sname_en
 * @property string $sname_ua
 * @property string $position_ru
 * @property string $position_en
 * @property string $position_ua
 * @property string $email
 * @property string $work_phone
 * @property string $mobile_phone
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $status
 */
class Team extends BaseModel
{
    public $fname;
    public $lname;
    public $sname;
    public $position;
    public $image_alt;
    public $image_title;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
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
            [['email', 'work_phone', 'mobile_phone'], 'required'],
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['updated_at', 'created_at', 'status'], 'integer'],
            [['email'], 'email'],
            [['image_alt_en', 'image_alt_ru', 'image_alt_ua',
                'image_title_en', 'image_title_ru', 'image_title_ua', 'fname_ru', 'fname_en', 'fname_ua', 'lname_ru',
                'lname_en', 'lname_ua', 'sname_ru', 'sname_en', 'sname_ua', 'position_ru', 'position_en', 'position_ua',
                 'work_phone', 'mobile_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'image' => Yii::t('app/admin', 'Фото'),
            'image_alt_en' => Yii::t('app/admin', 'Фото альтернативный текст'),
            'image_alt_ru' => Yii::t('app/admin', 'Фото альтернативный текст'),
            'image_alt_ua' => Yii::t('app/admin', 'Фото альтернативный текст'),
            'image_title_en' => Yii::t('app/admin', 'Фото заголовок'),
            'image_title_ru' => Yii::t('app/admin', 'Фото заголовок'),
            'image_title_ua' => Yii::t('app/admin', 'Фото заголовок'),
            'fname_ru' => Yii::t('app/admin', 'Имя'),
            'fname_en' => Yii::t('app/admin', 'Имя'),
            'fname_ua' => Yii::t('app/admin', 'Имя'),
            'lname_ru' => Yii::t('app/admin', 'Фамилия'),
            'lname_en' => Yii::t('app/admin', 'Фамилия'),
            'lname_ua' => Yii::t('app/admin', 'Фамилия'),
            'sname_ru' => Yii::t('app/admin', 'Отчество'),
            'sname_en' => Yii::t('app/admin', 'Отчество'),
            'sname_ua' => Yii::t('app/admin', 'Отчество'),
            'position_ru' => Yii::t('app/admin', 'Должность'),
            'position_en' => Yii::t('app/admin', 'Должность'),
            'position_ua' => Yii::t('app/admin', 'Должность'),
            'email' => Yii::t('app/admin', 'Email'),
            'work_phone' => Yii::t('app/admin', 'Рабочий телефон'),
            'mobile_phone' => Yii::t('app/admin', 'Мобильный телефон'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
            'status' => Yii::t('app/admin', 'Статус'),
        ];
    }

    public function afterFind()
    {
        $this->fname = $this->{self::getTranslate('fname')};
        $this->lname = $this->{self::getTranslate('lname')};
        $this->sname = $this->{self::getTranslate('sname')};
        $this->position = $this->{self::getTranslate('position')};
        $this->image_alt = $this->{self::getTranslate('image_alt')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        parent::afterFind();
    }
}
