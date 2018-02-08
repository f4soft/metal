<?php

namespace app\models\Filters;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CategoriesLink;
use app\models\ProductsCategories;

/**
 * CategoriesLinkSearch represents the model behind the search form about `app\models\CategoriesLink`.
 */
class CategoriesLinkSearch extends CategoriesLink
{
    
    public $owner_category;
    public $category_root;
    public $category;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['owner_category', 'category_root', 'category'], 'safe'],
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
        $tb_category_name = ProductsCategories::tableName();
                
        $query = CategoriesLink::find();
        $query->joinWith(['productCategory']);

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
            'owner_category_id' => $params['category_id'],            
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', $tb_category_name . '.title_' . self::$lang, $this->category]);
      
        return $dataProvider;
    }
}