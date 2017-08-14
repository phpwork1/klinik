<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Item;
use common\components\helpers\AppConst;

/**
 * ItemSearch represents the model behind the search form about `frontend\models\Item`.
 */
class ItemSearch extends Item
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_category_id', 'i_buy_price', 'i_sell_price', 'i_ppn', 'i_retail_price', 'i_net_price', 'i_blend_price', 'i_stock_amount', 'i_stock_min', 'i_stock_max'], 'integer'],
            [['i_name', 'i_barcode', 'i_description', 'i_factory', 'i_unit', 'i_expired_date'], 'safe'],
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
        $query = Item::find();
        $sort = ['defaultOrder' => ['i_name' => SORT_ASC]];
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

        if($this->i_expired_date != '') {
            $this->i_expired_date = Yii::$app->formatter->asDate($this->i_expired_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'item.id' => $this->id,
            'item.item_category_id' => $this->item_category_id,
            'item.i_buy_price' => $this->i_buy_price,
            'item.i_sell_price' => $this->i_sell_price,
            'item.i_ppn' => $this->i_ppn,
            'item.i_retail_price' => $this->i_retail_price,
            'item.i_net_price' => $this->i_net_price,
            'item.i_blend_price' => $this->i_blend_price,
            'item.i_stock_amount' => $this->i_stock_amount,
            'item.i_stock_min' => $this->i_stock_min,
            'item.i_stock_max' => $this->i_stock_max,
            'item.i_expired_date' => $this->i_expired_date,
        ]);

        $query->andFilterWhere(['like', 'item.i_name', $this->i_name])
            ->andFilterWhere(['like', 'item.i_barcode', $this->i_barcode])
            ->andFilterWhere(['like', 'item.i_description', $this->i_description])
            ->andFilterWhere(['like', 'item.i_factory', $this->i_factory])
            ->andFilterWhere(['like', 'item.i_unit', $this->i_unit]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
