<?php

namespace backend\modules\user\controllers;

use Yii;
use app\models\ModulesMaster;
use app\models\ModulesMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UserrolesModel;

/**
 * ModulemasterController implements the CRUD actions for ModulesMaster model.
 */
class ModulemasterController extends Controller
{
/* public function behaviors()
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
				        						'delete'
		        		
		        				   ],
		        				  'rules' => [
		        						       [
			        								'actions' => [
			        										'index',
			        										'create',
			        										'update',
			        										'view',
			        										'delete'
			        								],
			        								'allow' => true,
		        						       		'matchCallback' => function ($rule, $action) {
		        						       		return (UserrolesModel::getRole() == 1);
		        						       		}
			        								
		        								]
		        					]
        	                  ]
        	
        ];
    } */

    /**
     * Lists all ModulesMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModulesMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModulesMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModulesMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModulesMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->session->setFlash('success', "Modules  successfully Created");
        	 
            return $this->redirect(['view', 'id' => $model->moduleId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModulesMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->session->setFlash('success', "Modules  successfully Updated");
        	 
            return $this->redirect(['view', 'id' => $model->moduleId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModulesMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Modules .');
    		 
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Modules  is not deleted.');
    		 
    	}
      //  $this->findModel($id)->delete();
       // Yii::$app->session->setFlash('success', "Modules Masters successfully Deleted");
        return $this->redirect(['index']);
    }

    /**
     * Finds the ModulesMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModulesMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModulesMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
