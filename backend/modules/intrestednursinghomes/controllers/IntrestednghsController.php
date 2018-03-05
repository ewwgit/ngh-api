<?php

namespace app\modules\intrestednursinghomes\controllers;

use Yii;
use app\modules\intrestednursinghomes\models\IntrestedNghs;
use app\modules\intrestednursinghomes\models\IntrestednghsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Role;
use yii\helpers\ArrayHelper;
use backend\models\SignupConvertForm;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\intresteddoctors\models\IntrestedDoctors;

/**
 * IntrestednghsController implements the CRUD actions for Intrestednghs model.
 */
class IntrestednghsController extends Controller
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
     * Lists all Intrestednghs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntrestednghsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intrestednghs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new Intrestednghs();
    	$role_insn = IntrestedNghs::find()->where(['insnghid' => $id])->one();
    	
    	if(!empty($role_insn)){
    		
    		$model->role = $role_insn->role;
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
     * Creates a new Intrestednghs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
        $model = new Intrestednghs();
        $docModel = new IntrestedDoctors();
        $result = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), ''))
		{
			$model->createdDate = date('Y-m-d H:i:s');
			$model->status = 'Active';
			
			$emailcheck = IntrestedDoctors::find()->where(['email' => $model->email])->one();
			if($emailcheck)
			{
			
				$result['status'] = 'fail';
				$result['errors'][] = 'This email has already been taken';
				return $result; exit();
			}
			else{
				$emailcheck = Intrestednghs::find()->where(['email' => $model->email])->one();
				if($emailcheck)
				{
			
					$result['status'] = 'fail';
					$result['errors'][] = 'This email has already been taken';
					return $result; exit();
				}
			}
			$mobilecheck = IntrestedDoctors::find()->where(['mobile' => $model->mobile])->one();
			if($mobilecheck)
			{
				
        		$result['status'] = 'fail';
        		$result['errors'][] = 'This mobile number has already been taken';
        		return $result; exit();
			}
			else{
				$mobilecheck = Intrestednghs::find()->where(['mobile' => $model->mobile])->one();
				if($mobilecheck)
				{
				
					$result['status'] = 'fail';
					$result['errors'][] = 'This mobile number has already been taken';
					return $result; exit();
				}
			}
			
		
			
			if($model->role == 3)
			{
			
        	if($model->validate())
        	{
        		$ch = curl_init();
        		$message = 'Thank you '.$model->name.' for Registering with CONSULT.XP, we will send your user id, password soon.';
        		//$mb = '9951904473';
        		//$message = "Your OTP is";
        		$URL =  "http://sms.expertbulksms.com/WebServiceSMS.aspx?User=mulugu&passwd=Mulugu@123$&mobilenumber=".$model->mobile."&message=".urlencode($message)."&sid=mulugu&mtype=N";
        		/* echo $URL;
        		 exit(); */
        		curl_setopt($ch, CURLOPT_URL,$URL);
        			
        		
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		$server_output = curl_exec ($ch);
        		//print_r(var_dump($server_output));exit();
        		curl_close ($ch);
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
			}
			
			if($model->role == 2)
			{
				$docModel->role = $model->role;
				$docModel->name = $model->name;
				$docModel->email = $model->email;
				$docModel->description = $model->description;
				$docModel->mobile = $model->mobile;
				$docModel->createdDate = $model->createdDate;
				$docModel->createdDate = $model->status;
				
				
				if($docModel->validate())
				{
					$ch = curl_init();
					$message = 'Thank you DR '.$docModel->name.' for Registering with CONSULT.XP, we will send your user id, password soon.';
					//$mb = '9951904473';
					//$message = "Your OTP is";
					$URL =  "http://sms.expertbulksms.com/WebServiceSMS.aspx?User=mulugu&passwd=Mulugu@123$&mobilenumber=".$docModel->mobile."&message=".urlencode($message)."&sid=mulugu&mtype=N";
					/* echo $URL;
					 exit(); */
					curl_setopt($ch, CURLOPT_URL,$URL);
						
					
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec ($ch);
					//print_r(var_dump($server_output));exit();
					curl_close ($ch);
					if($docModel->save())
					{
						$result['status'] = 'success';
						$result['errors'] = [];
					}
					 
				}
				else {
			
					$result['status'] = 'fail';
					$validateerrors = $docModel->errors;
					foreach ($validateerrors as $k => $v)
					{
						$result['errors'][] = $validateerrors[$k][0];
						//print_r($validateerrors[$k]);exit();
					}
					//print_r($model->errors);exit();
				}
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
     * Updates an existing Intrestednghs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
        	
        	 $model->role = 3;
        	 $model->save();
        	 Yii::$app->session->setFlash('success', " Interested Nursing Homes Updated successfully ");
            return $this->redirect(['view', 'id' => $model->insnghid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Intrestednghs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Interested Nursing Home.');
    		 
    	}
    	 
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Interested Nursing Home is not deleted.');
    		 
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intrestednghs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Intrestednghs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intrestednghs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionConvertNursinghomes($id)
    {
        $interestednghInfo = Intrestednghs::find()->where(['insnghid' => $id])->one();
    	$model = new SignupConvertForm();
    	$model->email =  $interestednghInfo->email;
    	$nursinghomeModel = new Nursinghomes();
    	$nursinghomeModel->scenario = 'convertsneed';
    	$model->scenario = 'interested';
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate()){
    		$model->role= 2;
    		$userData = $model->signup();
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
    		$nursinghomeModel->nurshingUniqueId = $overallUniqueId;
    		$nursinghomeModel->nuserId = $userData->id;
    		$nursinghomeModel->description = $interestednghInfo->description;
    		$nursinghomeModel->createdDate = date('Y-m-d H:i:s');
    		$nursinghomeModel->updatedDate = date('Y-m-d H:i:s');
    		$nursinghomeModel->createdBy = Yii::$app->user->identity->id;
    		$nursinghomeModel->updatedBy = Yii::$app->user->identity->id;
    		$nursinghomeModel->save();
    		if($nursinghomeModel)
    		{
    			Intrestednghs::deleteAll(['insnghid'=> $id]);
    		}
    		//print_r($nursinghomeModel->errors);exit();
    		Yii::$app->session->setFlash('success', "Converted User to Nursing Homes Successfully ");
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('nursinghomes', [
    				'model' => $model,
    		]);
    	}
    
    }
}
