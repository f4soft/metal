<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['category_id', 'title_ru', 'title_ua', 'title_en', 'sku', 'image', 'image_alt_ru', 'image_alt_ua', 'image_alt_en', 'image_title_ru', 'image_title_ua', 'image_title_en', 'meta_keywords_ru', 'meta_keywords_ua', 'meta_keywords_en', 'meta_description_ru', 'meta_description_ua', 'meta_description_en', 'article_title_ru', 'article_title_ua', 'article_title_en', 'article_description_ru', 'article_description_ua', 'article_description_en'], 'safe'],
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
        $query = Products::find();

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
            'products.id' => $this->id,
            'products.status' => $this->status,
            'products.updated_at' => $this->updated_at,
            'products.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'products.title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'products.title_ua', $this->title_ua])
            ->andFilterWhere(['like', 'products.title_en', $this->title_en])
            ->andFilterWhere(['like', 'products.sku', $this->sku])
            ->andFilterWhere(['like', 'products.image', $this->image])
            ->andFilterWhere(['like', 'products.image_alt_ru', $this->image_alt_ru])
            ->andFilterWhere(['like', 'products.image_alt_ua', $this->image_alt_ua])
            ->andFilterWhere(['like', 'products.image_alt_en', $this->image_alt_en])
            ->andFilterWhere(['like', 'products.image_title_ru', $this->image_title_ru])
            ->andFilterWhere(['like', 'products.image_title_ua', $this->image_title_ua])
            ->andFilterWhere(['like', 'products.image_title_en', $this->image_title_en])
            ->andFilterWhere(['like', 'products.meta_keywords_ru', $this->meta_keywords_ru])
            ->andFilterWhere(['like', 'products.meta_keywords_ua', $this->meta_keywords_ua])
            ->andFilterWhere(['like', 'products.meta_keywords_en', $this->meta_keywords_en])
            ->andFilterWhere(['like', 'products.meta_description_ru', $this->meta_description_ru])
            ->andFilterWhere(['like', 'products.meta_description_ua', $this->meta_description_ua])
            ->andFilterWhere(['like', 'products.meta_description_en', $this->meta_description_en])
            ->andFilterWhere(['like', 'products.article_title_ru', $this->article_title_ru])
            ->andFilterWhere(['like', 'products.article_title_ua', $this->article_title_ua])
            ->andFilterWhere(['like', 'products.article_title_en', $this->article_title_en])
            ->andFilterWhere(['like', 'products.article_description_ru', $this->article_description_ru])
            ->andFilterWhere(['like', 'products.article_description_ua', $this->article_description_ua])
            ->andFilterWhere(['like', 'products.article_description_en', $this->article_description_en]);

        $query->joinWith('productCategory');
        $query->andFilterWhere(['like', 'products_categories.title_ru', $this->category_id]);

        return $dataProvider;
    }
}
