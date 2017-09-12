<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth ;
use common\models\User;
use app\models\UserSecurityTokens;

/**
 * Site controller
 */
class SiteController extends Controller
{
	
	
	/**
	 * Finds user by username and password
	 *
	 * @param string $username
	 * @param string $password
	 * @return static|null
	 */
	
    /**
     * @inheritdoc
     */
   /*  public function behaviors()
    {
    	$behaviors = parent::behaviors();
	
		$behaviors['contentNegotiator'] = [
				'class' => 'yii\filters\ContentNegotiator',
				'formats' => [
						'application/json' => Response::FORMAT_JSON,
				]
		];
	
		$behaviors['authenticator'] = [
				'class' => HttpBasicAuth::className(),
				'auth' => [$this, 'authenticate']
		];
	
		return $behaviors;
    }
		
		public function authenticate($username, $password)
		{
			// username, password are mandatory fields
			if(empty($username) || empty($password)) {
				return null;
			}
		
			// get user using requested email
			$user = User::findByUsername($username);
		
			// if no record matching the requested user
			if(empty($user)) {
				return null;
			}
		
			// if password validation fails
			if(!User::validatePassword($password)) {
				return null;
			}
		
			// if user validates (both user_email, user_password are valid)
			return $user;
		} */

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
    	$model = new LoginForm();
    	$tokenModel = new UserSecurityTokens();
    	$result = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
        	
             
        	if($model->userrole != $model->user->role)
        	{
        		$result['status'] = 'fail';
        		$result['errors'] = "You don't have valid credentials";
        	}
        	else{
             $result['status'] = 'success';
             $result['errors'] = [];
             $result['id'] = $model->user->id;
             $result['username'] = $model->user->username;
             $result['email'] = $model->user->email;
             $result['role'] = $model->user->role;
             $tokenModel->userId = $model->user->id;
             $tokenModel->token = \Yii::$app->security->generateRandomString();
             $tokenModel->status = 'Active';
             $tokenModel->createdDate = date('Y-m-d H:i:s');
             $tokenModel->save();
             $result['token'] = $tokenModel->token;
             //print_r($tokenModel->token);exit();
        	}
        } else {
        $result['status'] = 'fail';
        $result['errors'] = 'custom errors exist';
           //echo 'error';exit();
        }
        return $result;
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
