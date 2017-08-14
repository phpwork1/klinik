<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form about `frontend\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 's_phone_number'], 'integer'],
            [['s_name', 's_address', 's_contact_person', 's_file'], 'safe'],
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
        $query = Supplier::find();
        $sort = ['defaultOrder' => ['s_name' => SORT_ASC]];
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
            'supplier.id' => $this->id,
            'supplier.s_phone_number' => $this->s_phone_number,
        ]);

        $query->andFilterWhere(['like', 'supplier.s_name', $this->s_name])
            ->andFilterWhere(['like', 'supplier.s_address', $this->s_address])
            ->andFilterWhere(['like', 'supplier.s_contact_person', $this->s_contact_person])
            ->andFilterWhere(['like', 'supplier.s_file', $this->s_file]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
