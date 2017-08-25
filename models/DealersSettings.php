<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "block_settings".
 *
 * @property integer $id
 * @property string $dealers_title_ru
 * @property string $dealers_title_ua
 * @property string $dealers_title_en
 * @property string $dealers_page_description_ru
 * @property string $dealers_page_description_ua
 * @property string $dealers_page_description_en
 */
class DealersSettings extends BaseModel
{
    public $dealers_title;
    public $dealers_page_description;

    public function behaviors()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealers_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dealers_title_ru','dealers_title_ua','dealers_title_en',], 'string', 'max' => 255],
            [[ 'dealers_page_description_ru', 'dealers_page_description_ua','dealers_page_description_en'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'dealers_title_ru' => Yii::t('app/admin', 'Заголовок на странице дилеров рус'),
            'dealers_title_ua' => Yii::t('app/admin', 'Заголовок на странице дилеров укр'),
            'dealers_title_en' => Yii::t('app/admin', 'Заголовок на странице дилеров англ'),

            'dealers_page_description_ru' => Yii::t('app/admin', 'Описание на странице дилерам'),
            'dealers_page_description_ua' => Yii::t('app/admin', 'Описание на странице дилерам'),
            'dealers_page_description_en' => Yii::t('app/admin', 'Описание на странице дилерам'),
        ];
    }

    public function afterFind()
    {
        $this->dealers_page_description = $this->{self::getTranslate('dealers_page_description')};
        $this->dealers_title = $this->{self::getTranslate('dealers_title')};

        parent::afterFind();
    }

}
