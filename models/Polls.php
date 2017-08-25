<?php

namespace app\models;

use Yii;
use \app\models\QuestionsToPolls;

/**
 * This is the model class for table "polls".
 *
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property integer $total_votes
 * @property integer $is_multiple
 * @property integer $status
 * @property integer $alias
 * @property integer $updated_at
 * @property integer $created_at
 */
class Polls extends BaseModel
{
    public $title;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_votes', 'is_multiple', 'status', 'updated_at', 'created_at'], 'integer'],
            [['alias'], 'unique'],
            [['title_ru', 'title_ua', 'title_en', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),
            'total_votes' => Yii::t('app/admin', 'Общее колличество голосов'),
            'is_multiple' => Yii::t('app/admin', 'Множественный выбор'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public static function updateVote($id)
    {
        $model = self::findOne(["id" => $id]);
        $new_votes_count = $model->total_votes + 1;
        return self::updateAll(["total_votes" => $new_votes_count], ['=', 'id', $id]);
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        parent::afterFind();
    }

    static public function getLastPoll()
    {
        return self::find()->getActive()->orderBy('id DESC')->one();
    }

    public function isUserVote()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('pool_' . $this->id)) {
            return true;
        }
        return false;
    }

    public function getPollQuestions()
    {
        return $this->hasMany(QuestionsToPolls::className(), ['poll_id' => 'id'])->getActive()->all();
    }

    public function saveAnswers($data,$user_id)
    {
        $total_votes = 0;
        if (isset($data['poll'])) {

            $question = QuestionsToPolls::find()->where(['poll_id'=>$this->id, 'id'=> $data['poll']])->one();
            if (!empty($question)) {
                $question->votes_count = is_null($question->votes_count) ? 1 : $question->votes_count + 1;
                $question->save(false);
                $total_votes += 1;
            }
        }
        $userToPolls = new UsersToPollsQuestions();
        $userToPolls ->user_id = $user_id;
        $userToPolls ->question_poll_id = $this->id;
        if (!empty($data['email'])) {
            $userToPolls->email = $data['email'];
        }
        if (!empty($data['mess'])) {
            $userToPolls->message = $data['mess'];
        }
        $userToPolls->save(false);

        if (is_null($this->total_votes)) {
            $this->total_votes = $total_votes;
        } else {
            $this->total_votes += $total_votes;
        }
        $this->save();
    }
}
