<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BookRent;

/**
 * BookRentSearch represents the model behind the search form of `common\models\BookRent`.
 */
class BookRentSearch extends BookRent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_book_rent', 'rent_record_id', 'book_id'], 'integer'],
            [['created_at', 'created_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BookRent::find();

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
            'id_book_rent' => $this->id_book_rent,
            'rent_record_id' => $this->rent_record_id,
            'book_id' => $this->book_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }
}
