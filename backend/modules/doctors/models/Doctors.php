<?php

namespace app\modules\doctors\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "doctors".
 *
 * @property integer $doctorid
 * @property integer $userId
 * @property string $doctorUniqueId
 * @property string $name
 * @property string $qualification
 * @property string $city
 * @property integer $state
 * @property string $stateName
 * @property integer $country
 * @property string $countryName
 * @property string $address
 * @property string $pinCode
 * @property string $doctorMobile
 * @property resource $doctorImage
 * @property string $summery
 * @property string $APMC
 * @property string $TSMC
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	
	 public $username;
     public $email;
     public $password;
     public $confirmpassword;
     
     public $countriesList;
     public $statesData;
     public $citiesData;
     public $docimageupdate;
     public $status;
     public $qualification;
     public $allQuali;
     public $specialities;
     public $allSpeci;
     public $startTime;
     public $endTime;
     public $day;
	
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'qualification','specialities', 'city', 'state',  'country',  'address', 'permanentAddress', 'pinCode', 'doctorMobile',  'summery', 'APMC', 'TSMC','username','email','status'], 'required','on' => ['create','update','profileupdate']],
            [['userId', 'state', 'country', 'createdBy', 'updatedBy'], 'integer'],
            [[ 'address','summery','permanentAddress'], 'string'],
            [['stateName', 'countryName','createdDate', 'updatedDate','createdBy', 'updatedBy','name', 'qualification', 'city', 'state',  'country',  'address', 'permanentAddress', 'pinCode', 'doctorMobile', 'doctorImage', 'summery', 'APMC', 'TSMC','userId','doctorUniqueId','username','email','password'], 'safe'],
            [[ 'name', 'city', 'stateName', 'countryName', 'APMC', 'TSMC'], 'string', 'max' => 200],
        	[['docimageupdate','status'],'safe'],
        	[['availableStatus'],'required','on' =>['profileupdate']],
        	[['availableStatus'],'safe'],
        	['username', 'trim'],
            ['username', 'required','on' => ['create','update','profileupdate']],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on' =>'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required','on' => ['create','update','profileupdate']],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' =>'create'],

            ['password', 'required' ,'on' =>'create'],
        		['password',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => 'password Must be alphabates and numerics only.',
        		],
                ['password', 'string', 'min' => 6 ,'on' =>'create'],
        		[
        		'email',
        		'match',
        		'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        		'message' => 'Email can contain @ and .com characters.'
        				],

        		['username',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => 'Invalid username pattern.',
        		],
 
           // [['pinCode', 'doctorMobile'], 'string', 'max' => 20],
        		/* [
        		'username',
        		'unique',
        		'targetClass' => '\common\models\User',
        		'message' => 'User name already exists try for new',
        		'on' => 'create'
        				], */
        				/* [
        						'password',
        						'match',
        						// char and number and special symbol
        						'pattern' => '/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/',
        						'message' => 'should contain min 6 char with atleast 1 letter and 1 number'
        				],
        				[
        						'email',
        						'match',
        						'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        						'message' => 'Email can contain @ and .com characters.'
        				]
        				,
        		
        				['email','email'], */
        				[['confirmpassword'],'compare','compareAttribute' => 'password' ,'on' =>'create'],
        				['confirmpassword', 'required', 'on' => 'create'],
        		        ['password', 'required', 'on' => 'create'],
        		[
        		'pinCode',
        		'match',
        		'pattern' => '/^[0-9\s]{4,8}$/',
        		'message' => 'PinCode Must be between 4 and 8 numeric only.'
        				],
        		['doctorMobile','integer'],
        		['doctorMobile',
        				'match',
        				'pattern' => '/^[0-9]{10}$/',
        				'message' => 'mobile number must contain exactly 10 numbers.',
        		],
        		//['doctorImage','file','skipOnEmpty' => false],
        		[['doctorImage'],'required','on' => 'create'],
        		 //[['doctorImage'], 'image','skipOnEmpty'=>false,],
                 //[['doctorImage'], 'required']
        		[['userId','doctorUniqueId'],'required','on' => 'convertsneed'],
        		[['startTime','endTime','day'],'safe'],
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doctorid' => 'Doctorid',
            'userId' => 'User ID',
            'doctorUniqueId' => 'Doctor Unique ID',
            'name' => 'Name',
        	'username' => 'User Name',
        	'confirmpassword' => 'Confirm Password',
            'qualification' => 'Qualification',
        	'specialities' => 'Specialities',	
            'city' => 'City',
            'state' => 'State',
            'stateName' => 'State Name',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'address' => 'Present Address',
        	'permanentAddress' => 'Permanent Address',
            'pinCode' => 'Pin Code',
            'doctorMobile' => 'Mobile',
            'doctorImage' => 'Image',
            'summery' => 'Summery',
            'APMC' => 'APMC',
            'TSMC' => 'TSMC',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    
    public static function getDoctorsBySpeciality($specId)
    {
    	date_default_timezone_set("Asia/Calcutta");
    	$pDate = date("Y-M-d H:i:s");
    	$presentDay = date("D", strtotime($pDate));
    	$presentTime =  date("H:i", strtotime($pDate));
    	$doctorInfo = Doctors::find()->select('doctors.*,user.*,doctor_slots.*,doctors_specialities.*')->asArray()->innerJoin('user','doctors.userId=user.id')->leftJoin('doctor_slots','doctors.userId=doctor_slots.dsDoctorId')->innerJoin('doctors_specialities','doctors.userId=doctors_specialities.rdoctorId')->where("(user.status = 10 AND doctors_specialities.rspId = $specId) AND ((doctor_slots.startTime <= '$presentTime' AND doctor_slots.endTime >= '$presentTime' AND Day LIKE '$presentDay%') OR (doctors.availableStatus= 'Online'))")->all();
    	$avialableDoctors = array();
    	for($k=0;$k<count($doctorInfo); $k++)
    	{
    		if($doctorInfo[$k]['name'] != '')
    		{
    			$avialableDoctors[$k]['id'] = $doctorInfo[$k]['userId'];
    			$avialableDoctors[$k]['name'] = $doctorInfo[$k]['name'];
    		}
    	}
    	return $avialableDoctors;
    }
}
