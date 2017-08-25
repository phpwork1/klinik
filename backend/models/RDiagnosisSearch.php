<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RDiagnosisSearch represents the model behind the search form about `backend\models\RDiagnosis`.
 */
class RDiagnosisSearch extends RDiagnosis
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'registration_id'], 'integer'],
            [['rd_name'], 'safe'],
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
        $query = RDiagnosis::find();
        $sort = ['defaultOrder' => ['rd_name' => SORT_ASC]];
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
            'r_diagnosis.id' => $this->id,
            'r_diagnosis.registration_id' => $this->registration_id,
        ]);

        $query->andFilterWhere(['like', 'r_diagnosis.rd_name', $this->rd_name]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
