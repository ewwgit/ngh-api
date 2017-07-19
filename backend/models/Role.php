<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "role".
 *
 * @property integer $RoleId
 * @property string $RoleName
 * @property string $status
 * @property string $description
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $ipAddress
 *
 * @property Admin[] $admins
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
//         return [
//             [['RoleName', 'status', 'description'], 'required'],
//             [['status', 'description'], 'string'],
//             [['createdDate', 'updatedDate'], 'safe'],
//             [['RoleName', 'ipAddress'], 'string', 'max' => 200]
//         ];
        

        return [
        		[['status','RoleName','description'], 'required'],
        		[['status'], 'string'],
        		[['createdDate', 'updatedDate','description'], 'safe'],
        		
        		[
        		'RoleName',
        		'unique',
        		'message' => 'Role Name already exists try for new'
        		],
        		[
        		'RoleName',
        		'match',
        		'pattern' => '/^[a-zA-Z0-9\s]+$/',
        		'message' => 'Role Name  can only contain characters.'
        	   ],
        		[['RoleName'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RoleId' => 'Role ID',
            'RoleName' => 'Role Name',
            'status' => 'Status',
            'description' => 'Description',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'ipAddress' => 'Ip Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['roleId' => 'RoleId']);
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
    
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    
    		$this->ipAddress = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    		return true;
    	} else {
    		return false;
    	}
    }
    
    
}
