<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions_to_polls".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property integer $votes_count
 * @property integer $status
 * @property integer $alias
 * @property integer $updated_at
 * @property integer $created_at
 */
class QuestionsToPolls extends BaseModel
{
    public $title;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_to_polls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id'], 'required'],
            [['poll_id', 'votes_count', 'status', 'updated_at', 'created_at'], 'integer'],
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
            'poll_id' => Yii::t('app/admin', 'Голосование'),
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),
            'votes_count' => Yii::t('app/admin', 'Колличество голосов'),
            'status' => Yii::t('app/admin', 'Статус'),
            'updated_at' => Yii::t('app/admin', 'Дата обновления'),
            'created_at' => Yii::t('app/admin', 'Дата создания'),
        ];
    }

    public static function updateVote($id)
    {
        if(is_array($id)) {
            foreach ($id as $item) {
                $model = self::findOne(["id" => $item]);
                $new_votes_count = $model->votes_count + 1;
                self::updateAll(["votes_count" => $new_votes_count], ['=', 'id', $item]);
            }
        } else {
            $model = self::findOne(["id" => $id]);
            $new_votes_count = $model->votes_count + 1;
            self::updateAll(["votes_count" => $new_votes_count], ['=', 'id', $id]);
        }
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        parent::afterFind();
    }

    public static function getTotalByPollId($id)
    {
        $sql = 'SELECT  SUM(votes_count) as sum
                FROM    questions_to_polls
                WHERE   poll_id=:poll_id';
        return Yii::$app->db->createCommand($sql)->bindParam(':poll_id', $id)->queryAll()[0]['sum'];
    }
}
