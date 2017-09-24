<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\components\helpers\AppConst;
/**
 * RegistrationSearch represents the model behind the search form about `backend\models\Registration`.
 */
class RegistrationSearch extends Registration
{
    public $sum = NULL;

    public $dateTo;
    public $dateFrom;

    public $formNameParam = 'RegistrationSearch';

    /**
     * @inheritdoc
     */

    public function formName(){
        return $this->formNameParam;
    }

    public function rules()
    {
        return [
            [['r_paid','r_checked','id', 'patient_id', 'r_patient_weight', 'r_patient_tension', 'r_patient_temp', 'r_position'], 'integer'],
            [['r_number', 'r_date', 'r_complaint'], 'safe'],
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
        $query = Registration::find();
        $sort = ['defaultOrder' => ['r_date' => SORT_DESC]];
        $pagination = ['pageSize' => 2];

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            'pagination' => $pagination,
        ]);
        $dataProvider->pagination->pageParam = 'dp1';
        $dataProvider->pagination->pageSizeParam = 'dp1-size';
        $dataProvider->sort->sortParam = 'sp1';

        $dataProvider->sort->attributes['created_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['updated_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $this->load($params);

        if($this->r_date != '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'registration.id' => $this->id,
            'registration.patient_id' => $this->patient_id,
            'registration.r_date' => $this->r_date,
            'registration.r_patient_weight' => $this->r_patient_weight,
            'registration.r_patient_tension' => $this->r_patient_tension,
            'registration.r_patient_temp' => $this->r_patient_temp,
            'registration.r_position' => $this->r_position,
            'registration.r_checked' => $this->r_checked,
            'registration.r_paid' => $this->r_paid,
        ]);

        $query->andFilterWhere(['like', 'registration.r_number', $this->r_number])
            ->andFilterWhere(['like', 'registration.r_complaint', $this->r_complaint]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }

    public function searchAfterCheck($params)
    {
        $query = Registration::find();
        $sort = ['defaultOrder' => ['r_number' => SORT_ASC]];
        $pagination = ['pageSize' => 2];

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            'pagination' => $pagination,
        ]);

        $dataProvider->pagination->pageParam = 'dp2';
        $dataProvider->pagination->pageSizeParam = 'dp2-size';
        $dataProvider->sort->sortParam = 'sp2';

        $dataProvider->sort->attributes['created_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['updated_by'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $this->load($params);

        if($this->r_date != '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'registration.id' => $this->id,
            'registration.patient_id' => $this->patient_id,
            'registration.r_date' => $this->r_date,
            'registration.r_patient_weight' => $this->r_patient_weight,
            'registration.r_patient_tension' => $this->r_patient_tension,
            'registration.r_patient_temp' => $this->r_patient_temp,
            'registration.r_position' => $this->r_position,
            'registration.r_checked' => $this->r_checked,
            'registration.r_paid' => $this->r_paid,
        ]);

        $query->andFilterWhere(['like', 'registration.r_number', $this->r_number])
            ->andFilterWhere(['like', 'registration.r_complaint', $this->r_complaint]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }

    public function searchPatientReport($params)
    {
        $query = Registration::find();
        $sort = ['defaultOrder' => ['r_number' => SORT_DESC]];
        $pagination = ['pageSize' => 7];

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

        if($this->r_date != '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if($this->dateFrom != '') {
            $this->dateFrom = Yii::$app->formatter->asDate($this->dateFrom, AppConst::FORMAT_DB_DATE_PHP);
        }
        if($this->dateTo != '') {
            $this->dateTo = Yii::$app->formatter->asDate($this->dateTo, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'registration.id' => $this->id,
            'registration.patient_id' => $this->patient_id,
            'registration.r_date' => $this->r_date,
            'registration.r_patient_weight' => $this->r_patient_weight,
            'registration.r_patient_tension' => $this->r_patient_tension,
            'registration.r_patient_temp' => $this->r_patient_temp,
            'registration.r_position' => $this->r_position,
            'registration.r_checked' => $this->r_checked,
            'registration.r_paid' => $this->r_paid,
        ]);

        $query->andFilterWhere(['like', 'registration.r_number', $this->r_number])
            ->andFilterWhere(['like', 'registration.r_complaint', $this->r_complaint])
            ->andFilterWhere((['between', 'registration.r_date', $this->dateFrom, $this->dateTo]));

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }

    public function searchCheckedUser($params)
    {
        $query = Registration::find();
        $sort = ['defaultOrder' => ['r_date' => SORT_DESC]];
        $pagination = ['pageSize' => 5];

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

        if($this->r_date != '') {
            $this->r_date = Yii::$app->formatter->asDate($this->r_date, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'registration.id' => $this->id,
            'registration.patient_id' => $this->patient_id,
            'registration.r_date' => $this->r_date,
            'registration.r_patient_weight' => $this->r_patient_weight,
            'registration.r_patient_tension' => $this->r_patient_tension,
            'registration.r_patient_temp' => $this->r_patient_temp,
            'registration.r_position' => $this->r_position,
            'registration.r_checked' => 1,
            'registration.r_paid' => 0,
        ]);

        $query->andFilterWhere(['like', 'registration.r_number', $this->r_number])
            ->andFilterWhere(['like', 'registration.r_complaint', $this->r_complaint]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
