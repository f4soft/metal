<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news_token".
 *
 * @property integer $id
 * @property integer $news_subscriber_id
 * @property string $code
 */
class NewsToken extends BaseModel
{
    public function behaviors()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_subscriber_id'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'news_subscriber_id' => Yii::t('app/admin', 'News Subscriber ID'),
            'code' => Yii::t('app/admin', 'Code'),
        ];
    }

    static public function validateCode($code, $id)
    {
        $subscriber = NewsSubcribers::findOne($id);
        $token = self::findOne(['code'=>$code]);
        if ($subscriber && $token && $token->code == $code) {
            $token->delete();
            $subscriber->hash = Yii::$app->security->generateRandomString();
            $subscriber->confirmed_at = time();
            //$subscriber->status = 1;
            if($subscriber->update()){
                return true;
            }
        } else {
            return false;
        }
    }
}
