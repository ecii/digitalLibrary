<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RentRecord;

/**
 * RentRecordSearch represents the model behind the search form of `common\models\RentRecord`.
 */
class RentRecordSearch extends RentRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rent_record', 'profile_id'], 'integer'],
            [['return_at', 'rent_status', 'created_at', 'created_by'], 'safe'],
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
        $query = RentRecord::find();

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
            'id_rent_record' => $this->id_rent_record,
            'profile_id' => $this->profile_id,
            'return_at' => $this->return_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'rent_status', $this->rent_status]);

        return $dataProvider;
    }
}
