<?php
namespace app\models;

use yii\base\Model;
use common\models\User;
use backend\models\Role;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupFormadmin extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $file;
    public $roles;
    public $idproofs;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $profileImage;
    public $address;
    public $status;
    public $id;
    


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
        		[['firstName','lastName','phoneNumber','address','idproofs'] ,'required'],
           // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
        	['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on' =>'create'],
        		['username',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => 'Invalid username pattern.',
        		],
        		
        	['status','required'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
        	['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' =>'create'],
         //  ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        		[['password','file'], 'required', 'on' => 'create'],
        	
        	
           
            ['password', 'string', 'min' => 6],
        	['role','required'],
        		[['phoneNumber'],'integer'],
        		['phoneNumber',
        		'match',
        		'pattern' => '/^[0-9]{10}$/',
        		'message' => 'mobile number must contain exactly 10 numbers.',
        		],
        		
        	[['role','firstName','lastName','phoneNumber','profileImage','address','status','id'],'safe'],
        		
           ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function attributeLabels()
    {
    	return [
    			 
    			'username' => 'User Name',
    			'file' => 'Profile Image',
    			'firstName' => 'First Name',
    			'lastName' => 'Last Name',
    			'address' => 'Address',
    			'idproofs' => 'Id proofs',
    			 
    	];
    }
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
    public function getAllRoles()
    {
    
    	$allRolesobj = Role::find()->select(['RoleId','RoleName'])->where(('RoleId > 3'))->all();
    	//print_r($allRolesobj);exit();
    	$data = ArrayHelper::toArray($allRolesobj, [
    			'RoleId',
    			'RoleName'
    	]);
    
    	$roleIdCol = array_column($data, 'RoleId');
    	$RoleNameCol = array_column($data, 'RoleName');
    	$RolesData = array_combine($roleIdCol, $RoleNameCol);
    	return $RolesData;
    }
   
}
