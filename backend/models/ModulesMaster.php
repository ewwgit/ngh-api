<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "modules_master".
 *
 * @property integer $moduleId
 * @property string $moduleName
 * @property string $type
 * @property string $status
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $ipAddress
 *
 * @property AdminUserModules[] $adminUserModules
 */
class ModulesMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		
            [['moduleId', 'moduleName', 'type', 'status', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate', 'ipAddress'], 'safe'],
           // [['moduleId', 'createdBy', 'updatedBy'], 'integer'],
            //[['status'], 'string'],
            [['moduleName','status'], 'required'],
            //[['moduleName', 'type', 'ipAddress'], 'string', 'max' => 200]
        	['moduleName', 'unique', 
        	 'message' => 'This module has already been taken.'],
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moduleId' => 'Module ID',
            'moduleName' => 'Module Name',
            'type' => 'Type',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'ipAddress' => 'Ip Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminUserModules()
    {
        return $this->hasMany(AdminUserModules::className(), ['moduleId' => 'moduleId']);
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
    		$this->createdBy = Yii::$app->user->identity->id;
    		$this->updatedBy = Yii::$app->user->identity->id;
    		/* $convertedDate = strtotime($this->validFrom);
    		 $convertedEndDate = strtotime($this->validTo);
    		 $this->validFrom = date('Y-m-d',$convertedDate);
    		 $this->validTo = date('Y-m-d',$convertedEndDate); */
    		$this->ipAddress = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    		return true;
    	} else {
    		return false;
    	}
    }
}
