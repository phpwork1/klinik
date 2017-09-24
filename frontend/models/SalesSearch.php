<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\components\helpers\AppConst;

/**
 * SalesSearch represents the model behind the search form about `frontend\models\Sales`.
 */
class SalesSearch extends Sales
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 's_total_paid'], 'integer'],
            [['s_invoice_number', 's_date', 's_cashier', 's_buyer'], 'safe'],
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
    public function searchExternal($params)
    {
        $query = Sales::findBySql("SELECT * FROM sales WHERE id NOT IN (SELECT sales.id FROM sales INNER JOIN sales_type ON sales.id=sales_type.sales_id)");

        $sort = ['defaultOrder' => ['id' => SORT_ASC]];
        $pagination = ['pageSize' => 20];

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

        if($this->s_date != '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sales.id' => $this->id,
            'sales.s_date' => $this->s_date,
            'sales.s_total_paid' => $this->s_total_paid,
        ]);

        $query->andFilterWhere(['like', 'sales.s_invoice_number', $this->s_invoice_number])
            ->andFilterWhere(['like', 'sales.s_cashier', $this->s_cashier])
            ->andFilterWhere(['like', 'sales.s_buyer', $this->s_buyer]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }

    public function searchInternal($params)
    {
        $query = Sales::find()->joinWith(['salesTypes st'], true, 'INNER JOIN');
        $sort = ['defaultOrder' => ['id' => SORT_ASC]];
        $pagination = ['pageSize' => 20];

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

        if($this->s_date != '') {
            $this->s_date = Yii::$app->formatter->asDate($this->s_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sales.id' => $this->id,
            'sales.s_date' => $this->s_date,
            'sales.s_total_paid' => $this->s_total_paid,
        ]);

        $query->andFilterWhere(['like', 'sales.s_invoice_number', $this->s_invoice_number])
            ->andFilterWhere(['like', 'sales.s_cashier', $this->s_cashier])
            ->andFilterWhere(['like', 'sales.s_buyer', $this->s_buyer]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
