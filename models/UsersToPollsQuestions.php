<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_to_polls_questions".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $question_poll_id
 * @property string $email
 * @property string $message
 * @property integer $updated_at
 * @property integer $created_at
 */
class UsersToPollsQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_to_polls_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'question_poll_id', 'updated_at', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'user_id' => Yii::t('app/admin', 'User ID'),
            'question_poll_id' => Yii::t('app/admin', 'Question Poll ID'),
            'email' => Yii::t('app/admin', 'Email'),
            'message' => Yii::t('app/admin', 'Message'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }
}
