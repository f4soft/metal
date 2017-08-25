<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Team;

/**
 * TeamSearch represents the model behind the search form about `app\models\Team`.
 */
class TeamSearch extends Team
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'created_at'], 'integer'],
            [['image', 'image_alt_en', 'image_alt_ru', 'image_alt_ua', 'image_title_en', 'image_title_ru', 'image_title_ua', 'fname_ru', 'fname_en', 'fname_ua', 'lname_ru', 'lname_en', 'lname_ua', 'sname_ru', 'sname_en', 'sname_ua', 'position_ru', 'position_en', 'position_ua', 'email', 'work_phone', 'mobile_phone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Team::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_alt_en', $this->image_alt_en])
            ->andFilterWhere(['like', 'image_alt_ru', $this->image_alt_ru])
            ->andFilterWhere(['like', 'image_alt_ua', $this->image_alt_ua])
            ->andFilterWhere(['like', 'image_title_en', $this->image_title_en])
            ->andFilterWhere(['like', 'image_title_ru', $this->image_title_ru])
            ->andFilterWhere(['like', 'image_title_ua', $this->image_title_ua])
            ->andFilterWhere(['like', 'fname_ru', $this->fname_ru])
            ->andFilterWhere(['like', 'fname_en', $this->fname_en])
            ->andFilterWhere(['like', 'fname_ua', $this->fname_ua])
            ->andFilterWhere(['like', 'lname_ru', $this->lname_ru])
            ->andFilterWhere(['like', 'lname_en', $this->lname_en])
            ->andFilterWhere(['like', 'lname_ua', $this->lname_ua])
            ->andFilterWhere(['like', 'sname_ru', $this->sname_ru])
            ->andFilterWhere(['like', 'sname_en', $this->sname_en])
            ->andFilterWhere(['like', 'sname_ua', $this->sname_ua])
            ->andFilterWhere(['like', 'position_ru', $this->position_ru])
            ->andFilterWhere(['like', 'position_en', $this->position_en])
            ->andFilterWhere(['like', 'position_ua', $this->position_ua])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'work_phone', $this->work_phone])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone]);

        return $dataProvider;
    }
}
