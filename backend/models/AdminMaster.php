<?php

namespace app\models;

use Yii;
use app\models\Users;
use backend\models\Role;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 */
class AdminMaster extends \yii\db\ActiveRecord
{
	// public  $profileImage;
	public  $file;
	public $roles;
	public $password;
	public $oldPaidAmount;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    
    public function getAllRoles()
    {
    
    	$allRolesobj = Role::find()->select(['RoleId','RoleName'])->where(['status'=>'Active'])->all();
    	$data = ArrayHelper::toArray($allRolesobj, [
    			'RoleId',
    			'RoleName'
    	]);
    
    	$roleIdCol = array_column($data, 'RoleId');
    	$RoleNameCol = array_column($data, 'RoleName');
    	$RolesData = array_combine($roleIdCol, $RoleNameCol);
    	return $RolesData;
    }
    
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'firstName', 'lastName', 'roleId','idproofs'], 'required'],
            [['roleId','status'], 'integer'],
            [['createdDate', 'updatedDate', 'password_reset_token','password', 'auth_key','phoneNumber','roles','file','address','repOptions','oldPaidAmount','paidAmount'], 'safe'],
        	
            [['username', 'password_hash', 'email', 'firstName', 'lastName','profileImage'], 'string', 'max' => 200],
        	['username', 'match', 'pattern' => '/^\S*$/', 'message' => 'Sorry, you are not allowed name spaces'],
        	['username', 'match', 'pattern' => '/[a-zA-Z]/', 'message' => 'Your username can only contain characters.'],
        		[['email'],'email'],
        		[['file'],'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User Name',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
        	'idproofs' => 'Id proofs',
            'file' => 'profile Image',
            'roleId' => 'Role Name',
            'status' => 'Status',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }

    
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    		$adminUserModel = new Users();
    		$adminUserModel->setPassword($this->password_hash);
    		//print_r($adminUserModel->password_hash);exit();
    		$this->password_hash = $adminUserModel->password_hash;
    		return true;
    	} else {
    		return false;
    	}
    }
    public function getRole()
    {
    	return $this->hasOne(Role::className(), ['RoleId' => 'roleId']);
    }
    
    public function behaviors()
    {
    	return [
    			[
    					'class' => TimestampBehavior::className(),
    					'createdAtAttribute' => 'createdDate',
    					'updatedAtAttribute' => 'updatedDate',
    					'value' => new Expression('NOW()'),
    			],
    	];
    }
    
    public static function getUsername($uId) {
    	$usernamedata = AdminMaster::find()->select(['username'])->where(['id'=>$uId])->one();
    	return $usernamedata['username'];
    }
}
