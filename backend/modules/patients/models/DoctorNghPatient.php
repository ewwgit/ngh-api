<?php

namespace app\modules\patients\models;

use Yii;

/**
 * This is the model class for table "doctor_ngh_patient".
 *
 * @property integer $docnghpatId
 * @property integer $doctorId
 * @property integer $nugrsingId
 * @property integer $patientId
 * @property integer $patientHistoryId
 * @property string $treatment
 * @property string $patientRequestStatus
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class DoctorNghPatient extends \yii\db\ActiveRecord
{
	public $doctor;
	public $phsId;
	public $nursingHomeName;
	public $firstName;
	public $lastName;
	public $token;
	public $patientUniqueId;
	public $startdate;
	public $enddate;
	public $allcount;
	public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_ngh_patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctorId', 'nugrsingId', 'patientId', 'patientHistoryId', 'treatment', 'patientRequestStatus', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate','token'], 'safe'],
          /*   [['doctorId', 'nugrsingId', 'patientId', 'patientHistoryId', 'createdBy', 'updatedBy'], 'integer'],
            [['treatment', 'patientRequestStatus'], 'string'], */
            [['doctor','phsId','name'], 'safe'],
        	
        		
        		[['nursingHomeName','firstName','lastName','patientUniqueId','startdate','enddate','allcount','RequestType'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'docnghpatId' => 'Docnghpat ID',
            'doctorId' => 'Doctor ID',
            'nugrsingId' => 'Nugrsing ID',
            'patientId' => 'Patient ID',
            'patientHistoryId' => 'Patient History ID',
            'treatment' => 'Treatment',
            'patientRequestStatus' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
