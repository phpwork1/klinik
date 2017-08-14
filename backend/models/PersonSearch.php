<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Person;

/**
 * PersonSearch represents the model behind the search form about `backend\models\Person`.
 */
class PersonSearch extends Person
{
    public $sum = NULL;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'address', 'regency', 'province', 'country', 'birth_date', 'gender', 'religion', 'marriage_status', 'nationality', 'educational_level', 'dicipline', 'profession', 'majoring', 'email', 'mobile', 'phone', 'whatsapp', 'fb', 'bbm', 'line', 'skype', 'emergency_contact_name', 'emergency_contact_number', 'photo', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Person::find();
        $sort = ['defaultOrder' => ['name' => SORT_ASC]];
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
            'person.id' => $this->id,
            'person.created_at' => $this->created_at,
            'person.created_by' => $this->created_by,
            'person.updated_at' => $this->updated_at,
            'person.updated_by' => $this->updated_by,
            'person.deleted_at' => $this->deleted_at,
            'person.deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'person.name', $this->name])
            ->andFilterWhere(['like', 'person.address', $this->address])
            ->andFilterWhere(['like', 'person.regency', $this->regency])
            ->andFilterWhere(['like', 'person.province', $this->province])
            ->andFilterWhere(['like', 'person.country', $this->country])
            ->andFilterWhere(['like', 'person.birth_date', $this->birth_date])
            ->andFilterWhere(['like', 'person.gender', $this->gender])
            ->andFilterWhere(['like', 'person.religion', $this->religion])
            ->andFilterWhere(['like', 'person.marriage_status', $this->marriage_status])
            ->andFilterWhere(['like', 'person.nationality', $this->nationality])
            ->andFilterWhere(['like', 'person.educational_level', $this->educational_level])
            ->andFilterWhere(['like', 'person.dicipline', $this->dicipline])
            ->andFilterWhere(['like', 'person.profession', $this->profession])
            ->andFilterWhere(['like', 'person.majoring', $this->majoring])
            ->andFilterWhere(['like', 'person.email', $this->email])
            ->andFilterWhere(['like', 'person.mobile', $this->mobile])
            ->andFilterWhere(['like', 'person.phone', $this->phone])
            ->andFilterWhere(['like', 'person.whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'person.fb', $this->fb])
            ->andFilterWhere(['like', 'person.bbm', $this->bbm])
            ->andFilterWhere(['like', 'person.line', $this->line])
            ->andFilterWhere(['like', 'person.skype', $this->skype])
            ->andFilterWhere(['like', 'person.emergency_contact_name', $this->emergency_contact_name])
            ->andFilterWhere(['like', 'person.emergency_contact_number', $this->emergency_contact_number])
            ->andFilterWhere(['like', 'person.photo', $this->photo]);

        return (!empty($this->sum)) ? $query->sum($this->sum['field']) : $dataProvider;
    }
}
