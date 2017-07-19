<?php
namespace app\modules\nursinghomes\models;


use Yii;
use common\models\User;

/**
 * This is the model class for table "nursinghomes".
 *
 * @property integer $nursingId
 * @property integer $nuserId
 * @property string $nurshingUniqueId
 * @property string $contactPerson
 * @property string $mobile
 * @property string $city
 * @property integer $state
 * @property string $stateName
 * @property integer $country
 * @property string $countryName
 * @property string $pinCode
 * @property string $address
 * @property string $description
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Nursinghomes extends \yii\db\ActiveRecord
{
	 public $username;
     public $email;
     public $password;
     public $confirmpassword;
     public $status;
     public $nursingimageupdate;
     
     
     
     public $countriesList;
     public $statesData;
     public $citiesData;
     
   
	
	
    /**
     * @inheritdoc
     */ 
    public static function tableName()
    {
        return 'nursinghomes';
    }

    /**
     * @inheritdoc
     */
public function rules()
    {
        return [
        	
            [[ 'status','contactPerson', 'mobile', 'city', 'state',  'country', 'pinCode', 'address', 'description',
            		'username','email','landline','nursingHomeName'], 'required','on' => ['create','update']],
        		[['nursingImage','password'],'required','on' => 'create'],
            [['nuserId', 'state', 'country', 'createdBy', 'updatedBy','mobile','landline'], 'integer'],
            [['address', 'description'], 'string'],
            [['countriesList','updatedDate','createdDate','nuserId', 'nurshingUniqueId', 'contactPerson', 'mobile', 'city', 'state', 'stateName', 'country', 'countryName', 'pinCode', 'address', 'description','nursingImage',
            		'username','email','password','landline','nursingHomeName'], 'safe'],
            [['contactPerson', 'city', 'stateName', 'countryName'], 'string', 'max' => 200],
                 		
//         		[
//         		'username',
// 				'unique',
// 				'targetClass' => '\common\models\User',
// 				'message' => 'User name already exists try for new',
//         		'on' => 'create'
//         				],

        		
        		['username',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => ' username spacess are not allowed.',
        		],

        		['username', 'string', 'min' => 2, 'max' => 255],
        		['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on' =>'create'],
        		
        		[
        		'mobile',
        		'match',
        		'pattern'=>'/^[0-9]{10}$/',
        		'message' => 'should contain  max 10  number',
        		],
        		
        		[
        		'landline',
        		'match',
        		'pattern'=>'/^[0-9]{8,10}$/',
        		'message' => 'should contain min 8 max 10  number',
        		],

        		['password',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => 'password Must be alphabates and numerics only.',
        		],
        		  ['password', 'string', 'min' => 6],
        		
        		[
        		'email',
        		'match',
        		'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        		'message' => 'Email can contain @ and .com characters.'
        				]
        				,
        		['email', 'string', 'max' => 255],
        		['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' =>'create'],
        		
        		['email','email'],
      		    [['confirmpassword'],'compare','compareAttribute' => 'password'],
        		['confirmpassword', 'required', 'on' => 'create'],
        		[
        		'pinCode',
        		'match',
        		'pattern' => '/^[0-9\s]{4,8}$/',
        		'message' => 'PinCode Must be between 4 and 8 numeric only.'
        				],
        		[['nuserId','nurshingUniqueId'],'required','on' => 'convertsneed']
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nursingId' => 'Nursing ID',
            'nuserId' => 'Nuser ID',
            'nurshingUniqueId' => 'Nurshing Unique ID',
            'contactPerson' => 'Contact Person',
        		'username' => 'User Name',
        		'password' => 'Password',
        		'confirmpassword' => 'Confirm Password',
            'mobile' => 'Mobile',
            'city' => 'City',
            'state' => 'State',
            'stateName' => 'State Name',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'pinCode' => 'Pin Code',
            'address' => 'Address',
            'description' => 'Description',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'nuserId']);
    }
    public static function getUsername($uId) {
    	$usernamedata = User::find()->select(['username'])->where(['id'=>$uId])->one();
    	return $usernamedata['username'];
    }
}
