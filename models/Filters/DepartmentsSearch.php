<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Departments;

/**
 * DepartmentsSearch represents the model behind the search form about `app\models\Departments`.
 */
class DepartmentsSearch extends Departments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru','office_id', 'title_ua', 'title_en', 'phone', 'email', 'leader_fio_ru', 'leader_fio_ua', 'leader_fio_en'], 'safe'],
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
        $query = Departments::find();

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
            'departments.id' => $this->id,
            'departments.status' => $this->status,
            'departments.updated_at' => $this->updated_at,
            'departments.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'departments.title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'departments.title_ua', $this->title_ua])
            ->andFilterWhere(['like', 'departments.title_en', $this->title_en])
            ->andFilterWhere(['like', 'departments.phone', $this->phone])
            ->andFilterWhere(['like', 'departments.email', $this->email])
            ->andFilterWhere(['like', 'departments.leader_fio_ru', $this->leader_fio_ru])
            ->andFilterWhere(['like', 'departments.leader_fio_ua', $this->leader_fio_ua])
            ->andFilterWhere(['like', 'departments.leader_fio_en', $this->leader_fio_en]);

        $query->joinWith('office');
        $query->andFilterWhere(['like', 'offices.address_ru', $this->office_id]);

        return $dataProvider;
    }
}
