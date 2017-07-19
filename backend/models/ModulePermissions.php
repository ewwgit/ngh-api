<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "module_permissions".
 *
 * @property integer $mpId
 * @property integer $adminuserId
 * @property integer $moduleId
 * @property integer $permissions_add
 * @property integer $permissions_edit
 * @property integer $permissions_view
 * @property integer $permissions_all
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property integer $ipAddress
 */
class ModulePermissions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminuserId', 'moduleId', 'permissions_add', 'permissions_edit', 'permissions_view', 'permissions_all', 'createdBy', 'updatedBy',  'ipAddress'], 'safe'],
            [['adminuserId', 'moduleId', 'permissions_add', 'permissions_edit', 'permissions_view', 'permissions_all', 'createdBy', 'updatedBy', 'ipAddress'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mpId' => 'Mp ID',
            'adminuserId' => 'Adminuser ID',
            'moduleId' => 'Module ID',
            'permissions_add' => 'Permissions Add',
            'permissions_edit' => 'Permissions Edit',
            'permissions_view' => 'Permissions View',
            'permissions_all' => 'Permissions All',
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
    public function getModule()
    {
    	return $this->hasOne(ModulesMaster::className(), ['moduleId' => 'moduleId']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminuser()
    {
    	return $this->hasOne(Admin::className(), ['id' => 'adminuserId']);
    }
}
