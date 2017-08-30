<?php

namespace app\modules\intresteddoctors\controllers;

use Yii;
use app\modules\intresteddoctors\models\IntrestedDoctors;
use app\modules\intresteddoctors\models\IntresteddoctorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UserrolesModel;
use yii\filters\AccessControl;
use app\models\ModulePermissions;

use common\models\User;
use backend\models\Role;
use yii\helpers\ArrayHelper;
use backend\models\SignupConvertForm;
use app\modules\doctors\models\Doctors;

/**
 * IntresteddoctorsController implements the CRUD actions for Intresteddoctors model.
 */
class IntresteddoctorsController extends Controller
{
    
	
    public $layout = false;
    /**
     * Lists all Intresteddoctors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntresteddoctorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intresteddoctors model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new Intresteddoctors();
     	$role_insd = IntrestedDoctors::find()->where(['insdocid' => $id])->one();
     	if(!empty($role_insd)){
     		
     		$model->role = $role_insd->role;
     		$roleName = Role::find()->select('RoleName')->where( ['RoleId' => $model->role])->one();
     		$datas = ArrayHelper::toArray($roleName, ['RoleName']);
     		$data=implode($datas);
     		$model->role = $data;
     	
     	}
        return $this->render('view', [
           'model' => $this->findModel($id),
        		'data' =>$data,
        ]);
    }

    /**
     * Creates a new Intresteddoctors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
        $model = new Intresteddoctors();
        $result = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), ''))
		{
			$model->createdDate = date('Y-m-d H:i:s');
        	if($model->validate())
        	{
        	  if($model->save())
        	  {
        	  	$result['status'] = 'success';
        	  	$result['errors'] = [];
        	  }
        	  
        	}
        	else {
        		
        		$result['status'] = 'fail';
        		$validateerrors = $model->errors;
        		foreach ($validateerrors as $k => $v)
        		{
        			$result['errors'][] = $validateerrors[$k][0];
        			//print_r($validateerrors[$k]);exit();
        		}
        		//print_r($model->errors);exit();
        	}
        	//print_r($model->errors);exit();
        	return $result;
        	//Yii::$app->session->setFlash('success', " Interested Doctors Created successfully ");
            //return $this->redirect(['view', 'id' => $model->insdocid]);
        	//return $this->redirect(['index']);
        } else {
        	return $model;
        }
    }

    /**
     * Updates an existing Intresteddoctors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->session->setFlash('success', " Interested Doctors Updated successfully ");
            return $this->redirect(['view', 'id' => $model->insdocid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Intresteddoctors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       // $this->findModel($id)->delete();
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Interested Doctor.');
    		 
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Interested Doctor is not deleted.');
    		 
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intresteddoctors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Intresteddoctors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intresteddoctors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConvertDoctors($id)
    {
    	$interesteddocInfo = IntrestedDoctors::find()->where(['insdocid' => $id])->one();
    	$model = new SignupConvertForm();
    	$model->email =  $interesteddocInfo->email;
    	$docModel = new Doctors();
    	$docModel->scenario = 'convertsneed';
    	$model->scenario = 'interested';
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate()){
    		$model->role= 2;
    		$userData = $model->signup();
    		$presentDate = date('Y-m-d');
        	$doctorscount = Doctors::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	 exit(); */
        	$addnewid = $doctorscount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'DOC'.$dayval.$monthval.$dateInfo['year'];
    		$docModel->doctorUniqueId = $overallUniqueId;
    		$docModel->userId = $userData->id;
    		$docModel->summery = $interesteddocInfo->description;
    		$docModel->createdDate = date('Y-m-d H:i:s');
    		$docModel->updatedDate = date('Y-m-d H:i:s');
    		$docModel->createdBy = Yii::$app->user->identity->id;
    		$docModel->updatedBy = Yii::$app->user->identity->id;
    		$docModel->save();
    		if($docModel)
    		{
    			IntrestedDoctors::deleteAll(['insdocid'=> $id]);
    		}
    		//print_r($docModel->errors);exit();
    		Yii::$app->session->setFlash('success', "Converted User to Doctors Successfully ");
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('convertdoctors', [
    				'model' => $model,
    		]);
    	}
    
    }
}
