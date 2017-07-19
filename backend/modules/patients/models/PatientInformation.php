<?php

namespace app\modules\patients\models;

use Yii;

/**
 * This is the model class for table "patient_information".
 *
 * @property integer $patientInfoId
 * @property integer $patientId
 * @property string $height
 * @property string $weight
 * @property string $respirationRate
 * @property string $BPLeftArm
 * @property string $BPRightArm
 * @property string $pulseRate
 * @property string $temparatureType
 * @property string $diseases
 * @property string $allergicMedicine
 * @property string $createdDate
 * @property string $patientCompliant
 */
class PatientInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patientId', 'height', 'weight', 'respirationRate', 'BPLeftArm', 'BPRightArm', 'pulseRate', 'temparatureType', 'diseases', 'allergicMedicine', 'createdDate', 'patientCompliant'], 'required'],
            [['patientId'], 'integer'],
            [['createdDate'], 'safe'],
            [['patientCompliant'], 'string'],
            //[['height', 'weight', 'respirationRate', 'pulseRate'], 'string', 'max' => 5],
            [['BPLeftArm', 'BPRightArm', 'temparatureType', 'diseases', 'allergicMedicine'], 'string', 'max' => 200],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patientInfoId' => 'Patient Info ID',
            'patientId' => 'Patient ID',
            'height' => 'Height',
            'weight' => 'Weight',
            'respirationRate' => 'Respiration Rate',
            'BPLeftArm' => 'Bpleft Arm',
            'BPRightArm' => 'Bpright Arm',
            'pulseRate' => 'Pulse Rate',
            'temparatureType' => 'Temparature Type',
            'diseases' => 'Diseases',
            'allergicMedicine' => 'Allergic Medicine',
            'createdDate' => 'Created Date',
            'patientCompliant' => 'Patient Compliant',
        ];
    }
}
