<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_to_polls".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property integer $user_id
 * @property integer $updated_at
 * @property integer $created_at
 */
class UsersToPolls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_to_polls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'user_id'], 'required'],
            [['poll_id', 'user_id', 'updated_at', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'poll_id' => Yii::t('app/admin', 'Poll ID'),
            'user_id' => Yii::t('app/admin', 'User ID'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }
}
