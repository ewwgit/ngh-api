<?php
namespace app\modules\nursinghomes\controllers;

use Yii;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\nursinghomes\models\NursinghomesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Countries;
use app\models\States;

use common\models\User;
use yii\helpers\Json;
use backend\models\SignupForm;
use app\models\UserMain;
use yii\web\UploadedFile;
use backend\models\ChangePasswordForm;
use app\models\UserSecurityTokens;
use app\modules\patients\models\DoctorNghPatient;

/**
 * NursinghomesController implements the CRUD actions for Nursinghomes model.
 */
class NursinghomesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Nursinghomes models.
     * @return mixed
     */
    public function actionIndex()
    {
    	
        $searchModel = new NursinghomesSearch();
//         $params = Yii::$app->request->queryParams;
//         $params['role'] = 3;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        		         ]);
    }

    /**
     * Displays a single Nursinghomes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new User ();
         $model = User::find() ->where(['id' => $id])->one();
    	
            //$user = User::find() ->where(['id' =>yii::$app->user->id])->one();
           	//print_r(yii::$app->user->id);exit;
           	
    	 $model = $this->findModel($id);
      if (!$model) {
    		throw new NotFoundHttpException('model not found');
    	}
        return $this->render('view', [
            'model' => $this->findModel($id),
        	 // 'model' => $model,
        		        ]);
    }

    /**
     * Creates a new Nursinghomes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
 public function actionCreate()
    {
        $model = new Nursinghomes();
        $singupModel = new SignupForm();
        $model->scenario = 'create';
       // print_r( Yii::$app->user->identity->id);exit;
               
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
      
        if($model->country != ''){
        	
        	$model->state=States::getCountrysByStatesView($model->country );
        	
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
           	}
                 
        if ($model->load(Yii::$app->request->post()))
        {
        	$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
        	if($model->validate())
        	
        
        	{
        	$presentDate = date('Y-m-d');
        	$nursinghomescount = Nursinghomes::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	exit(); */
        	
        	$addnewid = $nursinghomescount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'NGH'.$dayval.$monthval.$dateInfo['year'];
        	//echo $uniqonlyId.'NGH'.$dayval.$monthval.$dateInfo['year'];exit();
        	$singupModel->username = $model->username;
        	$singupModel->email = $model->email;
        	$singupModel->password = $model->password;
        	$singupModel->role = 3;
        	$user = $singupModel->signup();
        	$model->email = 'dummy@mailinator.com';
        	$model->username = 'dummy';
//         	print_r($model->country);
//         	print_r($model->state);exit;
            $model->createdDate = date('Y-m-d H:i:s');
            $model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
            $model->nuserId = $user->id;
        	//$model->createdBy = 1;
        	
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;        	
        	$model->nurshingUniqueId = $overallUniqueId;
        	if(!(empty($model->nursingImage)))
        	{
        		 
        		$imageName = time().$model->nursingImage->name;
        		 
        		$model->nursingImage->saveAs('profileimages/'.$imageName );
        		 
        		$model->nursingImage = 'profileimages/'.$imageName;
        	}
        	$model->save();
        	//print_r($model);exit;
        	
          // return $this->redirect(['view', 'id' => $model->nuserId]);
        	Yii::$app->session->setFlash('success', " Nursing Homes Created successfully ");
           return $this->redirect(['index']);
                 
        }  else {
            return $this->render('create', [
                'model' => $model,
            	
                
            ]);
        }
       
        }
        else {
            return $this->render('create', [
                'model' => $model,
            	
                
            ]);
        }

   
    }

    /**
     * Updates an existing Nursinghomes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $singupModel = new SignupForm();
        $model->scenario = 'update';
   
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        $model->nursingimageupdate = $model->nursingImage;
        $model->nursingImage = '';
        
    //  print_r($model->country);exit;
        
      
     if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	
        	$model->statesData =[];
        	$model->state='';
        }
   
    
       $usermodel = User::find() ->where(['id' =>$model->nuserId])->one();
        if (! (empty ( $usermodel ))) {
            $model->username = $usermodel->username;
        	$model->email = $usermodel->email;
        	$model->status = $usermodel->status;
        	}
        	        	
        if (($model->load ( Yii::$app->request->post () )) && ($model->validate ())) {
        	
        	$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
          	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->updatedDate = date('Y-m-d H:i:s');
            $model->updatedBy = Yii::$app->user->identity->id;
        	$usermodel->status = $model->status;
        	$usermodel->save();
        	if(!(empty($model->nursingImage)))
        	{
        		 
        		$imageName = time().$model->nursingImage->name;
        		 
        		$model->nursingImage->saveAs('profileimages/'.$imageName );
        	
        		$model->nursingImage = 'profileimages/'.$imageName;
        		 
        	}
        	else {
        		$model->nursingImage = $model->nursingimageupdate;
        	}
            $model->save();
          	        
           // return $this->redirect(['view', 'id' => $model->nursingId]);
            Yii::$app->session->setFlash('success', " Nursing Homes Updated successfully ");
          	  return $this->redirect(['index']);
        } else {
              return $this->render('update', [
                'model' => $model,
              	
            ]);
        }
    }

    /**
     * Deletes an existing Nursinghomes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Nursing Home.');
    	
    	}
    	 
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Nursing Home is not deleted.');
    	
    	}
     //   $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nursinghomes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nursinghomes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nursinghomes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
  public function actionStates()
    {
    
    	$out = [];
    	if (isset($_POST['depdrop_parents'])) {
    		$parents = $_POST['depdrop_parents'];
    
    		if ($parents != null) {
    			$country = $parents[0];
    			$states = Countries::getStatesByCountry($country);
    			/* $out = [
    			 ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
    			 ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
    
    			 ]; */
    			echo Json::encode(['output'=>$states, 'selected'=>0]);
    			return;
    				
    				
    		}
    	}
    		
    	echo Json::encode(['output'=>'', 'selected'=>'']);
    		
    		
    }
   protected function finduserModel($uid)
    {
    	if (($usermodel = User::findOne($uid)) !== null) {
    		return $usermodel;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    public function actionProfileupdate($uid)
    {
    	$usermodel = $this->finduserModel($uid);
    	$model = Nursinghomes::find()->where(['nuserId' =>$usermodel->id])->one();
    	//print_r($model);exit();
    	$singupModel = new SignupForm();
    	$model->scenario = 'update';
    	 
    	$model->countriesList = Countries::getCountries();
    	$model->citiesData = [];
    	$model->nursingimageupdate = $model->nursingImage;
    	$model->nursingImage = '';
    
    	//  print_r($model->country);exit;
    
    
    	if($model->country != ''){
    
    		$model->statesData= Countries::getStatesByCountryupdate($model->country );
    
    	}else{
    		$model->country = $model->country;
    		 
    		$model->statesData =[];
    		$model->state='';
    	}
    	 
    
    	$usermodel = User::find() ->where(['id' =>$model->nuserId])->one();
    	if (! (empty ( $usermodel ))) {
    		$model->username = $usermodel->username;
    		$model->email = $usermodel->email;
    		$model->status = $usermodel->status;
    	}
    
    	if (($model->load ( Yii::$app->request->post () )) && ($model->validate ())) {
    		 
    		$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
    		$model->countryName = Countries::getCountryName($model->country);
    		$model->stateName = States::getStateName($model->state);
    		$model->updatedDate = date('Y-m-d H:i:s');
    		$model->updatedBy = Yii::$app->user->identity->id;
    		$usermodel->status = $model->status;
    		$usermodel->save();
    		if(!(empty($model->nursingImage)))
    		{
    			 
    			$imageName = time().$model->nursingImage->name;
    			 
    			$model->nursingImage->saveAs('profileimages/'.$imageName );
    			 
    			$model->nursingImage = 'profileimages/'.$imageName;
    			 
    		}
    		else {
    			$model->nursingImage = $model->nursingimageupdate;
    		}
    		$model->save();
    		 
    		// return $this->redirect(['view', 'id' => $model->nursingId]);
    		Yii::$app->session->setFlash('success', " Nursing Homes Updated successfully ");
    		return $this->redirect(['profileview','uid' => $usermodel->id]);
    		
    	} else {
    		return $this->render('profileupdate', [
    				'model' => $model,
    				 
    		]);
    	}
    }
    public function actionProfileview()
    {
        $uid = 0;
    	$token = '';
    	$result = array();
    	if(isset($_GET['uid']) && $_GET['uid'] != '')
    	{
    		$uid = $_GET['uid'];
    	}
    	
    	
    	if(isset($_GET['token']) && $_GET['token'] != '')
    	{
    		$token = $_GET['token'];
    	}
    	
    	if($token == '' || $uid == 0)
    	{
    		$result['status'] = 'fail';
    		$result['errors'] = "Please you can pass valid inputs";
    		return $result;exit();
    	}
    	
    	$usertokenAccess = UserSecurityTokens::find()->where(['userId' => $uid,'status' =>'Active','token' => $token])->one();
    	
    	if(empty($usertokenAccess))
    	{
    		$result['status'] = 'fail';
    		$result['errors'] = "You don't have valid token";
    		return $result;exit();
    	}
    	$usermodel = $this->finduserModel($uid);
    	$model = Nursinghomes::find()->where(['nuserId' =>$usermodel->id])->one();
    	
    	$result['status'] = 'success';
    	$result['errors'] = '';
    	$result['username'] = $usermodel->username;
    	$result['email'] = $usermodel->email;
    	$result['nurshingUniqueId'] = $model->nurshingUniqueId;
    	$result['contactPerson'] = $model->contactPerson;
    	$result['mobile'] = $model->mobile;
    	$result['landline'] = $model->landline;
    	$result['city'] = $model->city;
    	$result['stateName'] = $model->stateName;
    	$result['countryName'] = $model->countryName;
    	$result['pinCode'] = $model->pinCode;
    	$result['address'] = $model->address;
    	$result['nursingImage'] = 'http://expertwebworx.in/nghospital/backend/web/'.$model->nursingImage;
    	$result['description'] = $model->description;
    	$result['nursingHomeName'] = $model->nursingHomeName;
    	
    	return $result;
    }
    
    /**
     *  Reset Password
     */
    
    
    public function actionResetPassword($id)
    {
    	 
    	try {
    		$model = new ChangePasswordForm();
    	} catch (InvalidParamException $e) {
    		throw new BadRequestHttpException($e->getMessage());
    	}
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword($id)) {
    		Yii::$app->getSession()->setFlash('success', 'New password was saved.');
    
    		return $this->redirect(['index']);;
    	}
    
    	return $this->render('resetPassword', [
    			'model' => $model,
    	]);
    	
    }
    
    public function actionReports()
    {
    	$model = new Nursinghomes();
    
    	$result = array();
    
    	if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
    		 
    		$usertokenAccess = UserSecurityTokens::find()->where(['userId' => $model->nuserId,'status' =>'Active','token' => $model->token])->one();
    		 
    		if(empty($usertokenAccess))
    		{
    			$result['status'] = 'fail';
    			$result['errors'] = "You don't have valid token";
    			return $result;exit();
    		}
    		$requestInfo = DoctorNghPatient::find()->select('doctor_ngh_patient.doctorId,doctor_ngh_patient.docnghpatId,COUNT(doctor_ngh_patient.nugrsingId) as allcount,doctors.name')->innerJoin('doctors','doctors.userId=doctor_ngh_patient.doctorId')->where('doctor_ngh_patient.nugrsingId = '.$model->nuserId.' AND doctor_ngh_patient.patientRequestStatus="COMPLETED" AND (DATE(doctor_ngh_patient.updatedDate) >= "'.$model->startdate.'" AND DATE(doctor_ngh_patient.updatedDate) <= "'.$model->enddate.'")')->groupBy('doctor_ngh_patient.doctorId')->all();
    		//print_r($requestInfo);exit();
    		if(empty($requestInfo))
    		{
    			$result['status'] = 'fail';
    			$result['errors'] = "This Record not exist";
    			return $result;exit();
    		}
    		else{
    			 
    			$result['status'] = 'success';
    			$i = 0;
    			foreach ($requestInfo as $overallData)
    			{
    				$result['nursinghomesinfo'][$i]['doctorName'] = $overallData->name;
    				$result['nursinghomesinfo'][$i]['count'] = $overallData->allcount;
    				$i++;
    			}
    		}
    
    		return $result;
    	}
    }
    
    
    
}
