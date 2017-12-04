<?php

namespace app\modules\patients\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property integer $patientId
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $age
 * @property string $dateOfBirth
 * @property string $patientUniqueId
 * @property integer $country
 * @property string $countryName
 * @property integer $state
 * @property string $stateName
 * @property string $district
 * @property string $city
 * @property string $mandal
 * @property string $village
 * @property string $pinCode
 * @property string $mobile
 * @property string $createdDate
 * @property string $updatedDate
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $countriesList;
	public $statesData;
	public $citiesData;
	public $height;
	public $weight;
	public $respirationRate;
	public $BPLeftArm;
	public $BPRightArm;
	public $pulseRate;
	public $temparatureType;
	public $diseases;
	public $allergicMedicine;
	public $patientCompliant;
	public $documentUrl;
	public $patientimageupdate;
	public $previousRecords;
	public $bp;
	public $nghId;
	public $token;
	public $pId;
	public $spo2;
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName',  'gender', 'age','nghId'], 'required'],
             [['BPLeftArm'],'required'],
            [['gender'], 'string'],
            [['age','mobile','pinCode'],'integer'],
            [['dateOfBirth', 'createdDate', 'updatedDate','patientImage','patientimageupdate','previousRecords','createdBy','updatedBy','bp','token'], 'safe'],
            [['country', 'state'], 'integer'],
            [['firstName', 'lastName', 'patientUniqueId', 'countryName', 'stateName', 'district', 'city', 'mandal', 'village'], 'string', 'max' => 200],
           // [['age'], 'string', 'max' => 10],
            [['pinCode', 'mobile'], 'string', 'max' => 15],
        		['age',
        		'match',
        		'pattern' => '/^[0-9]+$/  ',
        		'message' => ' Invalid age Only numarics are allowed',
        		],
        		[
        		'mobile',
        		'match',
        		'pattern'=>'/^[0-9]{10}$/',
        		'message' => 'should contain  max 10  number',
        		],
        		[
        		'pinCode',
        		'match',
        		'pattern' => '/^[0-9\s]{4,8}$/',
        		'message' => 'PinCode Must be between 4 and 8 numeric only.'
        				],
        	[['height','weight','respirationRate','BPLeftArm','BPRightArm','pulseRate','temparatureType','diseases','allergicMedicine','createdDate','patientCompliant', 'createdDate', 'updatedDate', 'countryName', 'stateName', 'patientUniqueId','pId','spo2'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patientId' => 'Patient ID',
            'firstName' => 'Name',
            'lastName' => 'Last Name',
            'gender' => 'Gender',
            'age' => 'Age',
            'dateOfBirth' => 'Date Of Birth',
            'patientUniqueId' => 'Patient Unique ID',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'state' => 'State',
            'stateName' => 'State Name',
            'district' => 'District',
            'city' => 'City',
            'mandal' => 'Mandal',
            'village' => 'Village',
            'pinCode' => 'Pin Code',
            'mobile' => 'Mobile',
        	'temparatureType' => 'Temparature',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        		'documentUrl' => 'Patient Documents',
        	'BPLeftArm' => 'BP',
        	'nghId' => 'Nursing Home ID'
        ];
    }
    
    public function getPatientsinfonew()
    {
    	return $this->hasOne(PatientInformation::className(), ['patientId' => 'patientId'])->orderBy('patientInfoId DESC');
    }
}
