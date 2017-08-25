<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacancies;

/**
 * VacanciesSearch represents the model behind the search form about `app\models\Vacancies`.
 */
class VacanciesSearch extends Vacancies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'city_id', 'title_ua', 'title_en', 'department_title_ru',
                'department_title_ua', 'department_title_en', 'requirements_ru', 'requirements_ua',
                'requirements_en', 'description_ru', 'description_ua', 'description_en'], 'safe'],
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
        $query = Vacancies::find();

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
            'vacancies.id' => $this->id,
            'vacancies.status' => $this->status,
            'vacancies.updated_at' => $this->updated_at,
            'vacancies.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'vacancies.title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'vacancies.title_ua', $this->title_ua])
            ->andFilterWhere(['like', 'vacancies.title_en', $this->title_en])
            ->andFilterWhere(['like', 'vacancies.department_title_ru', $this->department_title_ru])
            ->andFilterWhere(['like', 'vacancies.department_title_ua', $this->department_title_ua])
            ->andFilterWhere(['like', 'vacancies.department_title_en', $this->department_title_en])
            ->andFilterWhere(['like', 'vacancies.requirements_ru', $this->requirements_ru])
            ->andFilterWhere(['like', 'vacancies.requirements_ua', $this->requirements_ua])
            ->andFilterWhere(['like', 'vacancies.requirements_en', $this->requirements_en])
            ->andFilterWhere(['like', 'vacancies.description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'vacancies.description_ua', $this->description_ua])
            ->andFilterWhere(['like', 'vacancies.description_en', $this->description_en]);

        $query->joinWith('city');
        $query->andFilterWhere(['like', 'cities.title_ru', $this->city_id]);

        return $dataProvider;
    }
}
