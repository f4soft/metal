<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offices;

/**
 * OfficesSearch represents the model behind the search form about `app\models\Offices`.
 */
class OfficesSearch extends Offices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_main', 'status', 'updated_at', 'created_at'], 'integer'],
            [['lat', 'long'], 'number'],
            [['address_ru', 'city_id', 'address_ua', 'address_en', 'phone', 'how_we_works_ru', 'how_we_works_ua', 'how_we_works_en'], 'safe'],
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
        $query = Offices::find();

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
            'lat' => $this->lat,
            'long' => $this->long,
            'is_main' => $this->is_main,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'address_ru', $this->address_ru])
            ->andFilterWhere(['like', 'address_ua', $this->address_ua])
            ->andFilterWhere(['like', 'address_en', $this->address_en])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'how_we_works_ru', $this->how_we_works_ru])
            ->andFilterWhere(['like', 'how_we_works_ua', $this->how_we_works_ua])
            ->andFilterWhere(['like', 'how_we_works_en', $this->how_we_works_en]);
        $query->joinWith('city');
        $query->andFilterWhere(['like', 'cities.title_ru', $this->city_id]);

        return $dataProvider;
    }
}
