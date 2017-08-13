<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ClinicalActionSearch represents the model behind the search form about `backend\models\ClinicalAction`.
 */
class ClinicalActionSearch extends ClinicalAction
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ca_cost'], 'integer'],
            [['ca_name'], 'safe'],
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
     * Create data provider summary instance with search query applied
     * @param array $params
     * @param array $sum
     * @return ActiveDataProvider
     */
    public function total($params = null, $sum = null) {
        $this->sum = $sum;
        return $this->search($params);
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
        $query = ClinicalAction::find();
        $sort = ['defaultOrder' => ['ca_name' => SORT_ASC]];
        $pagination = ['pageSize' => 10];

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            'pagination' => $pagination,
        ]);

        $dataProvider->sort->attributes['created_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['updated_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'clinical_action.id' => $this->id,
            'clinical_action.ca_cost' => $this->ca_cost,
        ]);

        $query->andFilterWhere(['like', 'clinical_action.ca_name', $this->ca_name]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
