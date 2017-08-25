<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cron_log".
 *
 * @property integer $id
 * @property string $last_date_run
 */
class CronLog extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cron_log';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_date_run'], 'required'],
            [['last_date_run'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_date_run' => 'Last Date Run',
        ];
    }

    static public function isCronWasRun()
    {
        $cron = self::find()->all();
        if(is_array($cron) && !count($cron)){
            return false;
        }
        return true;
    }
}
