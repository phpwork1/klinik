<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\components\helpers\AppConst;

/**
 * PatientSearch represents the model behind the search form about `backend\models\Patient`.
 */
class PatientSearch extends Patient
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'religion_id', 'job_id', 'patient_id', 'p_gender', 'p_postal_code', 'p_contact_number'], 'integer'],
            [['p_medical_number', 'p_registration_date', 'p_name', 'p_pob', 'p_dob', 'p_address', 'p_ref'], 'safe'],
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
        $query = Patient::find();
        $sort = ['defaultOrder' => ['p_name' => SORT_ASC]];
        $pagination = ['pageSize' => 12];

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

        if($this->p_dob != '') {
            $this->p_dob = Yii::$app->formatter->asDate($this->p_dob, AppConst::FORMAT_DB_DATE_PHP);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'patient.id' => $this->id,
            'patient.religion_id' => $this->religion_id,
            'patient.job_id' => $this->job_id,
            'patient.patient_id' => $this->patient_id,
            'patient.p_registration_date' => $this->p_registration_date,
            'patient.p_dob' => $this->p_dob,
            'patient.p_gender' => $this->p_gender,
            'patient.p_postal_code' => $this->p_postal_code,
            'patient.p_contact_number' => $this->p_contact_number,
        ]);


        $query->andFilterWhere(['like', 'patient.p_medical_number', $this->p_medical_number])
            ->andFilterWhere(['like', 'patient.p_name',  $this->p_name])
            ->andFilterWhere(['like', 'patient.p_pob', $this->p_pob])
            ->andFilterWhere(['like', 'patient.p_address', $this->p_address])
            ->andFilterWhere(['like', 'patient.p_ref', $this->p_ref]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
