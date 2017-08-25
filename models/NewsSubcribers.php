<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news_subcribers".
 *
 * @property integer $id
 * @property string $email
 * @property string $hash
 * @property string $language
 * @property integer $confirmed_at
 * @property integer $updated_at
 * @property integer $created_at
 */
class NewsSubcribers extends BaseModel
{
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
        return 'news_subcribers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['confirmed_at', 'updated_at', 'created_at'], 'integer'],
            [['email', 'hash', 'language'], 'string', 'max' => 255],
            [['email'], 'unique', 'message' => Yii::t('app', 'Значение {value} для {attribute} уже занято.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'email' => Yii::t('app/admin', 'Email'),
            'hash' => Yii::t('app/admin', 'Hash'),
            'language' => Yii::t('app/admin', 'Язык'),
            'status' => Yii::t('app/admin', 'Статус'),
            'confirmed_at' => Yii::t('app/admin', 'Confirmed At'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }

    static public function userSubscribed($code, $id)
    {
        $user = self::findOne($id);
        if ($user && $user->hash == $code) {
            $user->hash = Yii::$app->security->generateRandomKey();
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    static public function unsubscribe($id) {
        $user = self::findOne($id);
        if($user){
            $user->delete();
            return true;
        }
        return false;
    }
}
