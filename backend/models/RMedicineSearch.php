<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RMedicineSearch represents the model behind the search form about `backend\models\RMedicine`.
 */
class RMedicineSearch extends RMedicine
{
    public $sum = NULL;
    public $i_blended;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'registration_id', 'item_id', 'rmr_amount'], 'integer'],
            [['rmr_dosage_1', 'rmr_dosage_2', 'rmr_dosage_3', 'rmr_ref'], 'safe'],
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
        $query = RMedicine::find();
        $query->joinWith(['item i'], true, 'INNER JOIN');
        $sort = ['defaultOrder' => ['id' => SORT_ASC]];
        $pagination = ['pageSize' => 2];

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
            'r_medicine.id' => $this->id,
            'r_medicine.registration_id' => $this->registration_id,
            'r_medicine.item_id' => $this->item_id,
            'r_medicine.rmr_amount' => $this->rmr_amount,
            'i.i_blended' => false,
        ]);

        $query->andFilterWhere(['like', 'r_medicine.rmr_dosage_1', $this->rmr_dosage_1])
            ->andFilterWhere(['like', 'r_medicine.rmr_dosage_2', $this->rmr_dosage_2])
            ->andFilterWhere(['like', 'r_medicine.rmr_dosage_3', $this->rmr_dosage_3])
            ->andFilterWhere(['like', 'r_medicine.rmr_ref', $this->rmr_ref]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }

    public function searchBlended($params)
    {
        $query = RMedicine::find();

        $query->joinWith(['item i'], true, 'INNER JOIN');
        $sort = ['defaultOrder' => ['id' => SORT_ASC]];
        $pagination = ['pageSize' => 2];

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
            'i_id' => $this->item_id,
            'r_medicine.id' => $this->id,
            'r_medicine.registration_id' => $this->registration_id,
            'r_medicine.item_id' => $this->item_id,
            'r_medicine.rmr_amount' => $this->rmr_amount,
            'i.i_blended' => true,
        ]);

        $query->andFilterWhere(['like', 'r_medicine.rmr_dosage_1', $this->rmr_dosage_1])
            ->andFilterWhere(['like', 'r_medicine.rmr_dosage_2', $this->rmr_dosage_2])
            ->andFilterWhere(['like', 'r_medicine.rmr_dosage_3', $this->rmr_dosage_3])
            ->andFilterWhere(['like', 'r_medicine.rmr_ref', $this->rmr_ref]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
