<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User as UserModel;

/**
 * This is the model class for table "user".
 *
 * @property Person[] $person
 * @property url personLink
 */
class User extends UserModel {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson() {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\helpers\Url
     */
    public function getPersonLink() {
        if (!empty($this->person->name)) {
            $url = Url::toRoute(['person/view', 'id' => $this->person_id]);
            $options = ['escape' => false, 'title' => 'Person', 'target' => 'blank'];
            return Html::a($this->person->name, $url, $options);
        } else {
            return null;
        }
    }
    
}
