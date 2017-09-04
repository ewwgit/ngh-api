<?php

namespace app\modules\patients\controllers;

use Yii;
use app\modules\patients\models\Patients;
use app\modules\patients\models\PatientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Countries;
use app\models\States;
use yii\helpers\Json;
use app\modules\patients\models\PatientInformation;
use app\modules\patients\models\PatientDocuments;
use yii\web\UploadedFile;
use app\modules\doctors\models\Doctors;
use app\modules\patients\models\DoctorNghPatient;
use app\modules\doctors\models\DoctorsQualification;
use app\modules\qualifications\models\Qualifications;
use app\modules\doctors\models\DoctorsSpecialities;
use app\modules\specialities\models\Specialities;

/**
 * PatientsController implements the CRUD actions for Patients model.
 */
class PatientsController extends Controller
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
     * Lists all Patients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patients model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);
    	$patmodel = PatientInformation::find()->where(['patientId' =>$model->patientId])->one();
    	
        return $this->render('view', [
            'model' => $this->findModel($id),'patmodel' => $patmodel,
        ]);
    }

    /**
     * Creates a new Patients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patients();
        $patmodel = new PatientInformation();
        $newModel = new PatientDocuments();
       
        $result = array();
        
        	if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
        	$model->BPLeftArm = $model->bp;
        	$model->createdBy = $model->nghId;
        	$model->updatedBy = $model->nghId;
        	if($model->validate()){
        	
        	$presentDate = date('Y-m-d');
        	$patientscount = Patients::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	 exit(); */
        	$addnewid = $patientscount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'PAT'.$dayval.$monthval.$dateInfo['year'];
        	$model->patientUniqueId = $overallUniqueId;
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->updatedDate = date('Y-m-d H:i:s');
        	
        	$model->country = 101;
        	$model->state = 36;
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->dateOfBirth = $this->reverse_birthday($model->age);        	
        	$modelSuccess = $model->save();
        
        	$patmodel->BPLeftArm = $model->BPLeftArm;
        	
        	$patmodel->diseases = $model->diseases;
        	$patmodel->createdDate = date('Y-m-d H:i:s');
        	$patmodel->patientId = $model->patientId;
        	$patmodelSuccess = $patmodel->save();
        	
        	if($modelSuccess ==1 && $patmodelSuccess == 1){
        	
        	$result['status'] = 'success';
        	$result['errors'] = [];
        	}
        	else{
        		$result['status'] = 'fail';
        		$result['errors'][0] = 'Some error exist';
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
        	
        	return $result;
        
        }
    }
    
    public function reverse_birthday($years)
    {
    	return date('Y-m-d', strtotime($years . ' years ago'));
    }

    /**
     * Updates an existing Patients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $newModel = new PatientDocuments();
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
        $patmodel = PatientInformation::find()->where(['patientId' =>$model->patientId])->one();
      if (! (empty ( $patmodel )))
        {
        	$model->height = $patmodel->height;
        	$model->weight = $patmodel->weight;
        	$model->respirationRate = $patmodel->respirationRate;
        	$model->BPLeftArm = $patmodel->BPLeftArm;
        	$model->BPRightArm = $patmodel->BPRightArm;
        	$model->pulseRate = $patmodel->pulseRate;
        	$model->temparatureType = $patmodel->temparatureType;
        	$model->diseases = $patmodel->diseases;
        	$model->allergicMedicine = $patmodel->allergicMedicine;
        	$model->patientCompliant = $patmodel->patientCompliant;
        	
        }
        

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->dateOfBirth = date('Y-m-d', strtotime($model->dateOfBirth));
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->save();
        	
        	
        	$patmodel->height = $model->height;       
        	$patmodel->weight = $model->weight;
        	$patmodel->respirationRate = $model->respirationRate;
        	$patmodel->BPLeftArm = $model->BPLeftArm;
        	$patmodel->BPRightArm = $model->BPRightArm;
        	$patmodel->pulseRate = $model->pulseRate;
        	$patmodel->temparatureType = $model->temparatureType;
        	$patmodel->diseases = $model->diseases;
        	$patmodel->allergicMedicine = $model->allergicMedicine;
        	$patmodel->patientCompliant = $model->patientCompliant;
        	//print_r($patmodel->patientCompliant);exit();
        	//$patmodel->createdDate = date('Y-m-d H:i:s');
        	//print_r($patmodel->createdDate);exit();
        	$patmodel->save();
        	
        	$newModel->file = UploadedFile::getInstances($model, 'documentUrl');
        	$newModel->patientInfoId = $patmodel->patientInfoId;
        	$response = $newModel->upload();
        	
            //return $this->redirect(['view', 'id' => $model->patientId]);
        	Yii::$app->session->setFlash('success', " Patients Update successfully ");
        	return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Patients.');
    		 
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Patients is not deleted.');
    		 
    	}
    	
        return $this->redirect(['index']);
    }

    /**
     * Finds the Patients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patients::findOne($id)) !== null) {
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
    public function actionPatientshistorycreate()
    {
    	$id = '';
    	if(isset($_GET['id']) && $_GET['id'] != '')
    	{
    		$id = $_GET['id'];
    		$model = Patients::find()->where(['patientUniqueId' => $id])->one();
    		if(!empty($model))
    		{
    			$model->patientimageupdate = $model->patientImage;
    			$dateString=$model->dateOfBirth;
    			$years = round((time()-strtotime($dateString))/(3600*24*365.25));
    			$model->age = $years;
    			$model->dateOfBirth = date('d-M-Y',strtotime($dateString));
    			//echo $years;exit();
    			$patmodel = PatientInformation::find()->where(['patientId' =>$model->patientId])->orderBy('patientInfoId DESC')->one();
    			if (! (empty ( $patmodel )))
    			{
    				$model->height = $patmodel->height;
    				$model->weight = $patmodel->weight;
    				$model->respirationRate = $patmodel->respirationRate;
    				$model->BPLeftArm = $patmodel->BPLeftArm;
    				$model->BPRightArm = $patmodel->BPRightArm;
    				$model->pulseRate = $patmodel->pulseRate;
    				$model->temparatureType = $patmodel->temparatureType;
    				$model->diseases = $patmodel->diseases;
    				$model->allergicMedicine = $patmodel->allergicMedicine;
    				$model->patientCompliant = $patmodel->patientCompliant;
    				 
    			}
    			
    			$PrevousInfo = PatientInformation::find()->select(['patientInfoId','createdDate'])->where(['patientId' =>$model->patientId])->orderBy('createdDate DESC')->all();
    			$model->previousRecords= $PrevousInfo;
    		}
    		else {
    			$model = new Patients();
    			$patmodel = new PatientInformation();
    		}
    	}
    	else{
    		$model = new Patients();
    		$patmodel = new PatientInformation();
    	}
    	
        $newModel = new PatientDocuments();
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
       
        

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$model->patientImage = UploadedFile::getInstance($model,'patientImage');
        	
        	if($id != '')
        	{
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->dateOfBirth = date('Y-m-d', strtotime($model->dateOfBirth));
        	$model->updatedBy = Yii::$app->user->identity->id;
        	if(!(empty($model->patientImage)))
        	{
        		 
        		$imageName = time().$model->patientImage->name;
        		 
        		$model->patientImage->saveAs('patientimages/'.$imageName );
        		 
        		$model->patientImage = 'patientimages/'.$imageName;
        	}
        	else{
        		$model->patientImage = $model->patientimageupdate;
        	}
        	$model->save();
        	$patmodelnew = new PatientInformation();
        	$patmodelnew->patientId = $model->patientId;
        	$patmodelnew->height = $model->height;
        	$patmodelnew->weight = $model->weight;
        	$patmodelnew->respirationRate = $model->respirationRate;
        	$patmodelnew->BPLeftArm = $model->BPLeftArm;
        	$patmodelnew->BPRightArm = $model->BPRightArm;
        	$patmodelnew->pulseRate = $model->pulseRate;
        	$patmodelnew->temparatureType = $model->temparatureType;
        	$patmodelnew->diseases = $model->diseases;
        	$patmodelnew->allergicMedicine = $model->allergicMedicine;
        	$patmodelnew->patientCompliant = $model->patientCompliant;
        	$patmodelnew->createdDate = date('Y-m-d H:i:s');
        	$patmodelnew->save();
        	//print_r($patmodelnew->errors);exit();
        	}
        	else{
        	
        	$presentDate = date('Y-m-d');
        	$patientscount = Patients::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	 exit(); */
        	$addnewid = $patientscount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'PAT'.$dayval.$monthval.$dateInfo['year'];
        	$model->patientUniqueId = $overallUniqueId;
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->dateOfBirth = date('Y-m-d', strtotime($model->dateOfBirth));
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	if(!(empty($model->patientImage)))
        	{
        		 
        		$imageName = time().$model->patientImage->name;
        		 
        		$model->patientImage->saveAs('patientimages/'.$imageName );
        		 
        		$model->patientImage = 'patientimages/'.$imageName;
        	}
        	else{
        		$model->patientImage = '';
        	}
        	$model->save();
        	//print_r($model->patientId);exit();
        	$patmodelnew = new PatientInformation();
        	$patmodelnew->patientId = $model->patientId;
        	$patmodelnew->height = $model->height;
        	$patmodelnew->weight = $model->weight;
        	$patmodelnew->respirationRate = $model->respirationRate;
        	$patmodelnew->BPLeftArm = $model->BPLeftArm;
        	$patmodelnew->BPRightArm = $model->BPRightArm;
        	$patmodelnew->pulseRate = $model->pulseRate;
        	$patmodelnew->temparatureType = $model->temparatureType;
        	$patmodelnew->diseases = $model->diseases;
        	$patmodelnew->allergicMedicine = $model->allergicMedicine;
        	$patmodelnew->patientCompliant = $model->patientCompliant;
        	$patmodelnew->createdDate = date('Y-m-d H:i:s');
        	//print_r($patmodel->patientCompliant);exit();
        	//$patmodel->createdDate = date('Y-m-d H:i:s');
        	//print_r($patmodel->createdDate);exit();
        	$patmodelnew->save();
        	//print_r($patmodelnew->errors);exit();
        	}
        	
        	
        	
        	
        	$newModel->file = UploadedFile::getInstances($model, 'documentUrl');
        	$newModel->patientInfoId = $patmodelnew->patientInfoId;
        	
        	$response = $newModel->upload();
        	
            //return $this->redirect(['view', 'id' => $model->patientId]);
        	return $this->redirect(['request-doctor','phsId' => $patmodelnew->patientInfoId]);
        } else {
            return $this->render('patientshistorycreate', [
                'model' => $model,
            ]);
        }
    }
    protected function findinfoModel($infoid)
    {
    	if (($model = PatientInformation::findOne($infoid)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

    public function actionPatientshistoryview($infoid)
    {
    	$model = $this->findinfoModel($infoid);
    	$patmodel = Patients::find()->where(['patientId' =>$model->patientId])->one();
    	//print_r($model->height);exit();
    
    	return $this->render('patientshistoryview', [
    			'model' => $this->findinfoModel($infoid),'patmodel' => $patmodel,
    	]);
    }
    public function actionPatientshistorydocview($infoid)
    {
    	$model = $this->findinfoModel($infoid);
    	$patmodel = Patients::find()->where(['patientId' =>$model->patientId])->one();
    	$patdocmodel = PatientDocuments::find()->select('documentUrl')->where(['patientInfoId' =>$model->patientInfoId])->all();
    	//print_r($patdocmodel);exit();
    	$docary = array();
    	if(!empty($patdocmodel))
    	{
    		foreach ($patdocmodel as $doc)
    		{
    			$docary[] = $doc->documentUrl;
    			 
    		}
    	}
    	
    	//print_r($patdocmodel -> documentUrl);exit();
    	//print_r($patmodel->documentUrl);exit();
    
    	return $this->render('patientshistorydocview', ['model' => $this->findinfoModel($infoid),'patmodel' =>$patmodel,
    			'docary' => $docary,
    	]);
    }
    
    public function actionRequestDoctor($phsId)
    {
    	$model = new DoctorNghPatient;
    	$model->scenario = 'requestdoctor';
    	$mpatientModel = new Patients();
    	$mpatientInformationModel = new PatientInformation();
    	$model->phsId = $phsId;
    	$pDate = date("Y-M-d H:i:s");
    	$presentDay = date("D", strtotime($pDate));
    	$presentTime =  date("H:i", strtotime($pDate));
    	$avialableDoctors = array();
    	//echo $presentTime;exit();
    	$doctorInfo = Doctors::find()->select('doctors.*,user.*,doctor_slots.*')->innerJoin('user','doctors.userId=user.id')->innerJoin('doctor_slots','doctors.userId=doctor_slots.dsDoctorId')->where("user.status = 10 AND (doctor_slots.startTime <= '$presentTime' AND doctor_slots.endTime >= '$presentTime' AND Day LIKE '$presentDay%') OR (doctors.availableStatus= 'Online')")->all();
    	
    	foreach ($doctorInfo as $doc)
    	{
    		$avialableDoctors[$doc->userId] = $doc->name;
    	}
    	
    	$patientId = 0;
    	$nghId = 0;
    	$patientInfo = PatientInformation::find()->where(['patientInfoId' => $model->phsId])->one();
    	$patientId = $patientInfo->patientId;
    	if($patientId !=0)
    	{
    		$mpatientInformationModel = $patientInfo;
    		$nghInfo = Patients::find()->where(['patientId' => $patientId])->one();
    		$nghId = $nghInfo->createdBy;
    		$mpatientModel = $nghInfo;
    	}
    	
    	
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		
    		if($patientId != 0 && $nghId != 0)
    		{
    			
    		$reqeustalready = DoctorNghPatient::find()->where(['doctorId' => $model->doctor,'nugrsingId' => $nghId,'patientId' => $patientId,'patientHistoryId' => $model->phsId])->one();
    		//print_r($reqeustalready);exit();
    		if(empty($reqeustalready))	{
    		$model->doctorId = $model->doctor;
    		$model->nugrsingId = $nghId;
    		$model->patientId = $patientId;
    		$model->patientHistoryId = $model->phsId;
    		$model->patientRequestStatus = 'PROCESSING';
    		$model->doctorId = $model->doctor;
    		$model->createdDate = date('Y-m-d H:i:s');
    		$model->updatedDate = date('Y-m-d H:i:s');
    		$model->createdBy = Yii::$app->user->identity->id;
    		$model->updatedBy = Yii::$app->user->identity->id;
    		$model->save();
    		return $this->redirect(['index']);
    		}
    		else{
    			$model->addError('doctor','You are alreade requested to this doctor');
    		}
    		}
    		//print_r($nghId);exit();
    	}
    	
    	return $this->render('doctorRequest',
    			['avialableDoctors' => $avialableDoctors,'model' => $model,'mpatientModel' => $mpatientModel,'mpatientInformationModel' => $mpatientInformationModel]);
    	//print_r($avialableDoctors);exit();
    }
    
    public function actionDoctorInfo($docid)
    {
    	$doctroInfo = Doctors::find()->where(['userId' => $docid])->one();
    	$doctos = array();
    	if(!empty($doctroInfo))
    	{
    		$doctos['name'] = $doctroInfo->name;
    		$qualifications = DoctorsQualification::find()->where(['docId' => $docid])->all();
    		if(!empty($qualifications))
    		{
    			$qulary = array();
    			foreach ($qualifications as $quali)
    			{
    				$qulificatioName = Qualifications::find()->where(['qlid' => $quali->qualification])->one();
    				$qulary[] = $qulificatioName->qualification;
    			}
    			$doctos['qualification'] = implode(",",$qulary);
    		}
    		else {
    			$doctos['qualification'] = '';
    		}
    		
    		
    		$speciality = DoctorsSpecialities::find()->where(['rdoctorId' => $docid])->all();
    		if(!empty($speciality))
    		{
    			$splary = array();
    			foreach ($speciality as $splas)
    			{
    				$specialityName = Specialities::find()->where(['spId' => $splas->rspId])->one();
    				$splary[] = $specialityName->specialityName;
    			}
    			$doctos['speciality'] = implode(",",$splary);
    		}
    		else {
    			$doctos['speciality'] = '';
    		}
    		
    	}
    	
    	print_r(json_encode($doctos));exit();
    }
}
