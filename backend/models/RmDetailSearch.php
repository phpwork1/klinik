<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RmDetailSearch represents the model behind the search form about `backend\models\RmDetail`.
 */
class RmDetailSearch extends RmDetail
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'registration_id', 'r_medicine_id', 'item_id', 'rmd_amount'], 'integer'],
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
        $query = RmDetail::find();
        $sort = ['defaultOrder' => ['id' => SORT_ASC]];
        $pagination = ['pageSize' => 8];

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
            'rm_detail.id' => $this->id,
            'rm_detail.registration_id' => $this->registration_id,
            'rm_detail.r_medicine_id' => $this->r_medicine_id,
            'rm_detail.item_id' => $this->item_id,
            'rm_detail.rmd_amount' => $this->rmd_amount,
        ]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
