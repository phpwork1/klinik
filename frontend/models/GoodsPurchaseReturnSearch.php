<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\components\helpers\AppConst;

/**
 * GoodsPurchaseReturnSearch represents the model behind the search form about `frontend\models\GoodsPurchaseReturn`.
 */
class GoodsPurchaseReturnSearch extends GoodsPurchaseReturn
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goods_purchase_id', 'gpr_total_return'], 'integer'],
            [['gpr_return_number', 'gpr_date', 'gpr_supplier_name'], 'safe'],
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
        $query = GoodsPurchaseReturn::find();
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

        if($this->gpr_date != '') {
            $this->gpr_date = Yii::$app->formatter->asDate($this->gpr_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'goods_purchase_return.id' => $this->id,
            'goods_purchase_return.goods_purchase_id' => $this->goods_purchase_id,
            'goods_purchase_return.gpr_date' => $this->gpr_date,
            'goods_purchase_return.gpr_total_return' => $this->gpr_total_return,
        ]);

        $query->andFilterWhere(['like', 'goods_purchase_return.gpr_return_number', $this->gpr_return_number]);
        $query->andFilterWhere(['like', 'goods_purchase_return.gpr_supplier_name', $this->gpr_supplier_name]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
