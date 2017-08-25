<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\Cities;

/**
 * This is the model class for table "vacancies".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $department_title_ru
 * @property string $department_title_ua
 * @property string $department_title_en
 * @property string $requirements_ru
 * @property string $requirements_ua
 * @property string $requirements_en
 * @property string $description_ru
 * @property string $description_ua
 * @property string $description_en
 * @property integer $city_id
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Vacancies extends BaseModel
{
    public $title;
    public $department_title;
    public $requirements;
    public $description;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requirements_ru', 'requirements_ua', 'requirements_en', 'description_ru', 'description_ua', 'description_en'], 'string'],
            [['city_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'department_title_ru', 'department_title_ua', 'department_title_en'], 'string', 'max' => 255],
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

            'department_title_ru' => Yii::t('app/admin', 'Подразделение'),
            'department_title_ua' => Yii::t('app/admin', 'Подразделение'),
            'department_title_en' => Yii::t('app/admin', 'Подразделение'),

            'requirements_ru' => Yii::t('app/admin', 'Требования'),
            'requirements_ua' => Yii::t('app/admin', 'Требования'),
            'requirements_en' => Yii::t('app/admin', 'Требования'),

            'description_ru' => Yii::t('app/admin', 'Обязанности'),
            'description_ua' => Yii::t('app/admin', 'Обязанности'),
            'description_en' => Yii::t('app/admin', 'Обязанности'),

            'city_id' => Yii::t('app/admin', 'Город'),
            'status' => Yii::t('app/admin', 'Статус'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->department_title = $this->{self::getTranslate('department_title')};
        $this->requirements = $this->{self::getTranslate('requirements')};
        $this->description = $this->{self::getTranslate('description')};
        parent::afterFind();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getAll()
    {
        return self::find()->getActive()->with('city')->orderBy('id ASC')->all();
    }
    /**
     * Get city method
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

//    public function getCity()
//    {
//        return Cities::find()->where(['id' => $this->city_id])->one();
//    }
    /**
     * Get vacancies by city id
     * @param $cId
     * @return mixed
     */
    static public function getVacanciesById($cId)
    {
        return self::find()->where(['city_id' => $cId])->getActive()->all();
    }

    /**
     * Get vacancies by aslias
     * @param $alias
     * @return mixed
     */
    static public function getVacanciesByAlias($alias)
    {
        return self::find()->getActive()->where(['alias' => $alias])->all();
    }

}
