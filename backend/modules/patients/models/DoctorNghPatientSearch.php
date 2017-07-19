<?php

namespace app\modules\patients\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doctors\models\Doctors;

/**
 * DoctorsSearch represents the model behind the search form about `app\modules\doctors\models\Doctors`.
 */
class DoctorNghPatientSearch extends DoctorNghPatient
{
    /**
     * @inheritdoc
     */
	
	
    public function rules()
    {
        return [
            [['doctorId', 'nugrsingId', 'patientId', 'patientHistoryId', 'treatment', 'patientRequestStatus', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate','nursingHomeName','firstName','lastName'], 'safe'],
           
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
    public function search($params)
    {
        $docId = Yii::$app->user->identity->id;
    	$query = DoctorNghPatient::find()->select('doctor_ngh_patient.patientRequestStatus,doctor_ngh_patient.patientHistoryId,nursinghomes.nursingHomeName,patients.firstName,patients.lastName')->innerJoin('nursinghomes','doctor_ngh_patient.nugrsingId=nursinghomes.nuserId')->innerJoin('patient_information','doctor_ngh_patient.patientHistoryId=patient_information.patientInfoId')->innerJoin('patients','patient_information.patientId=patients.patientId')->where("doctor_ngh_patient.doctorId =".$docId);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        		'sort' => ['attributes' => ['doctorId', 'nugrsingId', 'patientId', 'patientHistoryId', 'treatment', 'patientRequestStatus', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate','nursingHomeName','firstName','lastName']],
        		
        		
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //$query->joinWith('user');
        // grid filtering conditions
       // print_r($query);exit();
        $query->andFilterWhere([
            'doctorId' => $this->doctorId,
            'nugrsingId' => $this->nugrsingId,
            'patientId' => $this->patientId,
            'patientHistoryId' => $this->patientHistoryId,
            'treatment' => $this->treatment,
            'patientRequestStatus' => $this->patientRequestStatus,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'doctorId', $this->doctorId])
            ->andFilterWhere(['like', 'nugrsingId', $this->nugrsingId])
            ->andFilterWhere(['like', 'patientId', $this->patientId])
            ->andFilterWhere(['like', 'patientHistoryId', $this->patientHistoryId])
            ->andFilterWhere(['like', 'treatment', $this->treatment])
             ->andFilterWhere(['like', 'nursinghomes.nursingHomeName', $this->nursingHomeName])
             ->andFilterWhere(['like', 'patients.firstName', $this->firstName])
             ->andFilterWhere(['like', 'patients.lastName', $this->lastName])
             ->andFilterWhere(['like', 'patientRequestStatus', $this->patientRequestStatus])
            ->andFilterWhere(['like', 'patientRequestStatus', $this->patientRequestStatus])
            ->andFilterWhere(['like', 'patientRequestStatus', $this->patientRequestStatus])
            ->andFilterWhere(['like', 'createdDate', $this->createdDate])
            ->andFilterWhere(['like', 'updatedDate', $this->updatedDate]);

        return $dataProvider;
    }
}
