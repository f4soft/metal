<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articles;

/**
 * ArticlesSearch represents the model behind the search form about `app\models\Articles`.
 */
class ArticlesSearch extends Articles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title_ru', 'title_ua', 'title_en', 'description_ru', 'description_ua',
                'description_en', 'image_alt_ru', 'image_alt_ua', 'image_alt_en', 'image_title_ru', 'image_title_ua', 'image_title_en', 'meta_keywords_ru', 'meta_keywords_ua', 'meta_keywords_en', 'meta_description_ru', 'meta_description_ua', 'meta_description_en', 'alias'], 'safe'],
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
        $query = Articles::find();

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
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'title_ua', $this->title_ua])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_ua', $this->description_ua])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'image_alt_ru', $this->image_alt_ru])
            ->andFilterWhere(['like', 'image_alt_ua', $this->image_alt_ua])
            ->andFilterWhere(['like', 'image_alt_en', $this->image_alt_en])
            ->andFilterWhere(['like', 'image_title_ru', $this->image_title_ru])
            ->andFilterWhere(['like', 'image_title_ua', $this->image_title_ua])
            ->andFilterWhere(['like', 'image_title_en', $this->image_title_en])
            ->andFilterWhere(['like', 'meta_keywords_ru', $this->meta_keywords_ru])
            ->andFilterWhere(['like', 'meta_keywords_ua', $this->meta_keywords_ua])
            ->andFilterWhere(['like', 'meta_keywords_en', $this->meta_keywords_en])
            ->andFilterWhere(['like', 'meta_description_ru', $this->meta_description_ru])
            ->andFilterWhere(['like', 'meta_description_ua', $this->meta_description_ua])
            ->andFilterWhere(['like', 'meta_description_en', $this->meta_description_en])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
