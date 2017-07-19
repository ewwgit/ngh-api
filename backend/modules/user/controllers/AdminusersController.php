<?php

namespace backend\modules\user\controllers;

use Yii;
/* use app\models\AdminMaster;
use app\models\AdminMasterSearch; */
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UserrolesModel;
use app\models\Users;
use app\models\ModulesMaster;
use app\models\ModulesMasterSearch;
use app\models\ModulePermissions;
use yii\web\UploadedFile;
use app\models\SignupFormadmin;
use backend\models\Role;
use app\models\AdminInformation;
use app\models\UserMainSearch;
use yii\helpers\ArrayHelper;
use common\models\User;

use app\models\AdminMaster;
/**
 * AdminusersController implements the CRUD actions for AdminMaster model.
 */
class AdminusersController extends Controller
{
    public function behaviors()
    {
    	
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        		'access' => [
        				'class' => AccessControl::className(),
        				'only' => [
        						
        						'index',
        						'create',
        						'update',
        						'view',
        						'delete',
        						'permissions',
        						'permissionsupdate'
        		
        				],
        				'rules' => [
        						[
        								'actions' => [
        										'index',
        						                'create',
        										'update',
        										'view',
        										'delete',
        										'permissions',
        										'permissionsupdate'
        								],
        								'allow' => true,
        								'matchCallback' => function ($rule, $action) {
        									return (UserrolesModel::getRole() == 1);
        								}
        						]
        						]
        						]
        ];
    }

    /**
     * Lists all AdminMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        
    	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        		
        ]);
    }

    /**
     * Displays a single AdminMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new SignupFormadmin();
    	$adminInfo = new AdminInformation();
    	$adminuser = User::find()->where(['id' => $id])->one();
    	
    	if(!empty($adminuser))
    	{
    		$model->username = $adminuser->username;
    		$model->email = $adminuser->email;
    		$model->status = $adminuser->status;
    		$model->role = $adminuser->role;
    		//print_r($model->role);exit;
    		$roleName = Role::find()->select('RoleName')->where( ['RoleId' => $model->role])->one();
    		
    		$datas = ArrayHelper::toArray($roleName, ['RoleName']);
    		$data=implode($datas);
    		$model->role = $data;
    		$adminInfo = AdminInformation::find()->where(['aduserId' => $adminuser->id])->one();
        if(!empty($adminInfo))
        {
        $model->firstName = $adminInfo->firstName;
        $model->lastName = $adminInfo->lastName;
        $model->address = $adminInfo->address;
        $model->profileImage = $adminInfo->profileImage;
        $model->phoneNumber = $adminInfo->phoneNumber;
        $model->idproofs = $adminInfo->idproofs;
        }
    	}
        return $this->render('view', [
            'model' => $model,
        		'data' =>$data,
        ]);
    }

    /**
     * Creates a new AdminMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 public function actionCreate()
    {
        $model = new SignupFormadmin();
        $admininfo = new AdminInformation();
        $model->scenario = 'create';

      if ($model->load(Yii::$app->request->post()) )
        {
        	$model->file = UploadedFile::getInstance($model,'file');
        	if($model->validate())
        	{
        	$user = $model->signup();
        	$admininfo->aduserId = $user->id;
        	$admininfo->firstName = $model->firstName;
        	$admininfo->lastName = $model->lastName;      	
        	$admininfo->phoneNumber = $model->phoneNumber;
        	$admininfo->address = $model->address ;
        	$admininfo->idproofs = $model->idproofs;
        	
        	
        	if($model->file != '')
        	{
        		$imageName = rand(1000,100000).$model->file->baseName;
        		$model->file->saveAs('profileimages/'.$imageName.'.'.$model->file->extension );
        		 
        		$model->profileImage = 'profileimages/'.$imageName.'.'.$model->file->extension;
        		$admininfo->profileImage= $model->profileImage;
        	}
        	//echo $model->profileImage;exit();
         $admininfo->save();
         Yii::$app->session->setFlash('success', " Adminuser Created successfully ");
         return $this->redirect(['index']);
        	}
        	else {

        		$Roles = $model->getAllRoles();
        		$newroles = array();
        		foreach ($Roles as $key => $val)
        		{
        			if(($val != 'Super Admin')&& ($val != 'Doctor')&& ($val != 'Nursing Home') ){
        				$newroles [$key] = $val;
        			}
        			 
        		
        		}
        		
        		 
        		$model->roles = $newroles;
        		return $this->render('create', [
        				'model' => $model,
        		]);
        		
        	}
         
        	
        	
        } else {
            $Roles = $model->getAllRoles();
            $newroles = array();
            foreach ($Roles as $key => $val)
            {
            	if(($val != 'Super Admin')&& ($val != 'Doctor')&& ($val != 'Nursing Home') ){
            	$newroles [$key] = $val;
            	}
            	
            	 
            }
             /* for ($i=1;$i<=count($Roles);$i++)
             {
             	if(($Roles[$i] != 'super admin')&& ($Roles[$i] != 'user') )
             	{
             		$newroles [$i] = $Roles[$i];
             	}
             } */
             
        $model->roles = $newroles;
        return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    

    /**
     * Updates an existing AdminMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$model = new SignupFormadmin();
    	$adminInfo = new AdminInformation();
        $adminuser = User::find()->where(['id' => $id])->one();
        
        if(!empty($adminuser))
        {
        $model->username = $adminuser->username;
        $model->email = $adminuser->email;
        $model->status = $adminuser->status;
        $model->role = $adminuser->role;
        $adminInfo = AdminInformation::find()->where(['aduserId' => $adminuser->id])->one();
        if(!empty($adminInfo))
        {
        $model->firstName = $adminInfo->firstName;
        $model->lastName = $adminInfo->lastName;
        $model->address = $adminInfo->address;
        $model->profileImage = $adminInfo->profileImage;
        $model->phoneNumber = $adminInfo->phoneNumber;
        $model->idproofs = $adminInfo->idproofs;
        }
        }
        
     if ($model->load(Yii::$app->request->post()))
        	 {
        	$model->file = UploadedFile::getInstance($model,'file');
        	 	if($model->validate())
        	 	{
        	
        	$adminuser->username = $model->username;
        	$adminuser->email = $model->email;
        	$adminuser->status = $model->status ;
        	$adminuser->role = $model->role ;
        	if($model->password != '')
        	{
        		$adminuser->setPassword($model->password);
        	}
        	$adminuser->update();
        	//print_r($adminuser->id);exit();
        	
        	$adminInfo->aduserId = $adminuser->id;
        	$adminInfo->firstName = $model->firstName;
        	$adminInfo->lastName = $model->lastName; 
        	$adminInfo->phoneNumber = $model->phoneNumber;
        	$adminInfo->idproofs = $model->idproofs;
        	
        	$adminInfo->address = $model->address ;
        	
        	
        	if($model->file != '')
        	{
        		$imageName = rand(1000,100000).$model->file->baseName;
        		$model->file->saveAs('profileimages/'.$imageName.'.'.$model->file->extension );
        		 
        		$model->profileImage = 'profileimages/'.$imageName.'.'.$model->file->extension;
        		$adminInfo->profileImage= $model->profileImage;
        	}
        	//echo $model->profileImage;exit();
         $adminInfo->save();
         Yii::$app->session->setFlash('success', " Adminuser Updated successfully ");
            return $this->redirect(['index']);
        	 	}
        	 	else {
        	 		$Roles = $model->getAllRoles();
        	 		$newroles = array();
        	 		 
        	 		foreach ($Roles as $key => $val)
        	 		{
        	 			if(($val != 'Super Admin')&& ($val != 'Doctor')&& ($val != 'Nursing Home') ){
        	 				$newroles [$key] = $val;
        	 			}
        	 			 
        	 		}
        	 		/* for ($i=1;$i<=count($Roles);$i++)
        	 		 {
        	 		 if(($Roles[$i] != 'super admin')&& ($Roles[$i] != 'user') )
        	 		 {
        	 		 $newroles [$i] = $Roles[$i];
        	 		 }
        	 		 } */
        	 		 
        	 		$model->roles = $newroles;
        	 		return $this->render('update', [
        	 				'model' => $model,
        	 		]);
        	 	}
        } else {
            $Roles = $model->getAllRoles();
            $newroles = array();
           
            foreach ($Roles as $key => $val)
            {
            	if(($val != 'Super Admin')&& ($val != 'Doctor')&& ($val != 'Nursing Home') ){
            	$newroles [$key] = $val;
            	}
            	
            }
             /* for ($i=1;$i<=count($Roles);$i++)
             {
             	if(($Roles[$i] != 'super admin')&& ($Roles[$i] != 'user') )
             	{
             		$newroles [$i] = $Roles[$i];
             	}
             } */
             
        $model->roles = $newroles;
        return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted admin user.');
    		
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Admin user is not deleted.');
    		
    	}
    	
    	return $this->redirect(['index']);
    }
    
    public function actionPermissions($id)
    {
    	
    	$searchModel = new ModulesMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new User();
        $adminuser = User::find()->where(['id' => $id])->one();
        $model->id = $adminuser->id;
        return $this->render('permissions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'model' => $model
        ]);
    }
    
    public function actionPermissionsupdate($permissiontype,$userid,$moduleid)
    {
    	$modulePermissions = ModulePermissions::find()->where(['moduleId' =>$moduleid,'adminuserId'=> $userid])->one();
    	$success= 0;
    	if($modulePermissions == NULL)
    	{
    		$modulePermissionsRtm = new ModulePermissions();
    		if($permissiontype == 'permission-add')
    		{
    			$modulePermissionsRtm->permissions_add = 1;
    		}
    		else 
    		{
    			$modulePermissionsRtm->permissions_add = 0;
    		}
    		if($permissiontype == 'permission-edit')
    		{
    			$modulePermissionsRtm->permissions_edit = 1;
    		}
    		else
    		{
    			$modulePermissionsRtm->permissions_edit = 0;
    		}
    		if($permissiontype == 'permission-delete')
    		{
    			$modulePermissionsRtm->permissions_delete = 1;
    		}
    		else
    		{
    			$modulePermissionsRtm->permissions_delete = 0;
    		}
    		if($permissiontype == 'permission-view')
    		{
    			$modulePermissionsRtm->permissions_view = 1;
    		}
    		else
    		{
    			$modulePermissionsRtm->permissions_view = 0;
    		}
    		if($permissiontype == 'permission-all')
    		{
    			$modulePermissionsRtm->permissions_all = 1;
    			$modulePermissionsRtm->permissions_add = 1;
    			$modulePermissionsRtm->permissions_edit = 1;
    			$modulePermissionsRtm->permissions_delete = 1;
    			$modulePermissionsRtm->permissions_view = 1;
    		}
    		else
    		{
    			$modulePermissionsRtm->permissions_all = 0;
    		}
    		$modulePermissionsRtm->moduleId = $moduleid;
    		$modulePermissionsRtm->adminuserId = $userid;
    		$modulePermissionsRtm->save();
    		$success= 1;
    		
    	}
    	else {
		    	if($permissiontype == 'permission-add')
		    	{
		    		$permissionAdd = $modulePermissions['permissions_add'];
		    		if($permissionAdd == 0)
		    		{
		    			
		    			$modulePermissions->permissions_add = 1;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else if($permissionAdd == 1)
		    		{
		    			$modulePermissions->permissions_add = 0;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else
		    		{
		    			$modulePermissionsNew = new ModulePermissions();
		    			$modulePermissionsNew->moduleId = $moduleid;
		    			$modulePermissionsNew->adminuserId = $userid;
		    			$modulePermissionsNew->permissions_add = 1;
		    			$modulePermissionsNew->save();
		    			$success= 1;
		    		}
		    		
		    	}
		    	if($permissiontype == 'permission-edit')
		    	{
		    		$permissionEdit = $modulePermissions['permissions_edit'];
		    		if($permissionEdit == 0)
		    		{
		    			 
		    			$modulePermissions->permissions_edit = 1;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else if($permissionEdit == 1)
		    		{
		    			$modulePermissions->permissions_edit = 0;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else
		    		{
		    			$modulePermissionsNew = new ModulePermissions();
		    			$modulePermissionsNew->moduleId = $moduleid;
		    			$modulePermissionsNew->adminuserId = $userid;
		    			$modulePermissionsNew->permissions_edit = 1;
		    			$modulePermissionsNew->save();
		    			$success= 1;
		    		}
		    	
		    	}
		    	if($permissiontype == 'permission-delete')
		    	{
		    		$permissionDelete = $modulePermissions['permissions_delete'];
		    		if($permissionDelete == 0)
		    		{
		    	
		    			$modulePermissions->permissions_delete = 1;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else if($permissionDelete == 1)
		    		{
		    			$modulePermissions->permissions_delete = 0;
		    			$modulePermissions->update();
		    			$success= 1;
		    	
		    		}
		    		else
		    		{
		    			$modulePermissionsNew = new ModulePermissions();
		    			$modulePermissionsNew->moduleId = $moduleid;
		    			$modulePermissionsNew->adminuserId = $userid;
		    			$modulePermissionsNew->permissions_delete = 1;
		    			$modulePermissionsNew->save();
		    			$success= 1;
		    		}
		    		 
		    	}
		    	if($permissiontype == 'permission-view')
		    	{
		    		$permissionView = $modulePermissions['permissions_view'];
		    		if($permissionView == 0)
		    		{
		    	
		    			$modulePermissions->permissions_view = 1;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else if($permissionView == 1)
		    		{
		    			$modulePermissions->permissions_view = 0;
		    			$modulePermissions->update();
		    			$success= 1;
		    	
		    		}
		    		else
		    		{
		    			$modulePermissionsNew = new ModulePermissions();
		    			$modulePermissionsNew->moduleId = $moduleid;
		    			$modulePermissionsNew->adminuserId = $userid;
		    			$modulePermissionsNew->permissions_view = 1;
		    			$modulePermissionsNew->save();
		    			$success= 1;
		    		}
		    		 
		    	}
		    	if($permissiontype == 'permission-all')
		    	{
		    		$permissionAll = $modulePermissions['permissions_all'];
		    		if($permissionAll == 0)
		    		{
		    			$modulePermissions->permissions_add = 1;
		    			$modulePermissions->permissions_edit = 1;
		    			$modulePermissions->permissions_delete = 1;
		    			$modulePermissions->permissions_view = 1;
		    			$modulePermissions->permissions_all = 1;
		    			$modulePermissions->update();
		    			$success= 1;
		    		}
		    		else if($permissionAll == 1)
		    		{
		    			$modulePermissions->permissions_add = 0;
		    			$modulePermissions->permissions_edit = 0;
		    			$modulePermissions->permissions_delete = 0;
		    			$modulePermissions->permissions_view = 0;
		    			$modulePermissions->permissions_all = 0;
		    			$modulePermissions->update();
		    			$success= 1;
		    			 
		    		}
		    		else
		    		{
		    			$modulePermissionsNew = new ModulePermissions();
		    			$modulePermissionsNew->moduleId = $moduleid;
		    			$modulePermissionsNew->adminuserId = $userid;
		    			$modulePermissionsNew->permissions_all = 1;
		    			$modulePermissionsNew->save();
		    			$success= 1;
		    		}
		    		 
		    	}
    	}
    	if($success == 1)
    	{
    		Yii::$app->session->setFlash('success', 'You are successfully updated permissions.');
    		return $this->redirect(['permissions', 'id' => $userid]);
    	}
    }
    

    /**
     * Finds the AdminMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
   /*  protected function findModel($id)
    {
        if (($model = AdminMaster::findOne($id)) !== null) {
        	
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } */
}
