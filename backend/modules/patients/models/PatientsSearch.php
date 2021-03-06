<?php

namespace app\modules\patients\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\patients\models\Patients;
use app\models\UserrolesModel;

/**
 * PatientsSearch represents the model behind the search form about `app\modules\patients\models\Patients`.
 */
class PatientsSearch extends Patients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patientId', 'country', 'state'], 'integer'],
            [['firstName', 'lastName', 'gender', 'age', 'dateOfBirth', 'patientUniqueId', 'countryName', 'stateName', 'district', 'city', 'mandal', 'village', 'pinCode', 'mobile', 'createdDate', 'updatedDate','aadhar_number'], 'safe'],
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
    public function search($nghId)
    {
    	
        $query = Patients::find()->where(['createdBy' => $nghId]);
    	

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'pagination' =>false,
        ]);

        
        $query->joinWith('patientsinfonew');

        // grid filtering conditions
        $query->andFilterWhere([
            'patientId' => $this->patientId,
            'dateOfBirth' => $this->dateOfBirth,
            'country' => $this->country,
            'state' => $this->state,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'patientUniqueId', $this->patientUniqueId])
            ->andFilterWhere(['like', 'countryName', $this->countryName])
            ->andFilterWhere(['like', 'stateName', $this->stateName])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'mandal', $this->mandal])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'pinCode', $this->pinCode])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
