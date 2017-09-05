<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\components\helpers\AppConst;
/**
 * GoodsPurchaseSearch represents the model behind the search form about `frontend\models\GoodsPurchase`.
 */
class GoodsPurchaseSearch extends GoodsPurchase
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'gp_payment_method', 'gp_discount', 'gp_ppn'], 'integer'],
            [['gp_invoice_number', 'gp_date', 'gp_due_date', 'gp_cashier'], 'safe'],
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
        $query = GoodsPurchase::find();
        $sort = ['defaultOrder' => ['gp_invoice_number' => SORT_ASC]];
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

        if($this->gp_date != '') {
            $this->gp_date = Yii::$app->formatter->asDate($this->gp_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'goods_purchase.id' => $this->id,
            'goods_purchase.supplier_id' => $this->supplier_id,
            'goods_purchase.gp_date' => $this->gp_date,
            'goods_purchase.gp_payment_method' => $this->gp_payment_method,
            'goods_purchase.gp_due_date' => $this->gp_due_date,
            'goods_purchase.gp_discount' => $this->gp_discount,
            'goods_purchase.gp_ppn' => $this->gp_ppn,
        ]);

        $query->andFilterWhere(['like', 'goods_purchase.gp_invoice_number', $this->gp_invoice_number])
            ->andFilterWhere(['like', 'goods_purchase.gp_cashier', $this->gp_cashier]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
