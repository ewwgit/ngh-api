<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupConvertForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $confirmpassword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on' =>'interested'],
        	//['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on' =>'convertnursinghomes'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
           // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' =>'create'],

            ['password', 'required' ,'on' =>'create'],
           
        		['password', 'string', 'min' => 6 ],
        		[
        		'email',
        		'match',
        		'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        		'message' => 'Email can contain @ and .com characters.'
        				],
        		//['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email has already been taken.','on' =>'convertdoctors'],
        		['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email has already been taken.','on' =>'interested'],

        		['username',
        		'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
        		'message' => 'Invalid username pattern.',
        		],
 
           // [['pinCode', 'doctorMobile'], 'string', 'max' => 20],
        		/* [
        		'username',
        		'unique',
        		'targetClass' => '\common\models\User',
        		'message' => 'User name already exists try for new',
        		'on' => 'create'
        				], */
        				/* [
        						'password',
        						'match',
        						// char and number and special symbol
        						'pattern' => '/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/',
        						'message' => 'should contain min 6 char with atleast 1 letter and 1 number'
        				],
        				[
        						'email',
        						'match',
        						'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        						'message' => 'Email can contain @ and .com characters.'
        				]
        				,
        		
        				['email','email'], */
        				[['confirmpassword'],'compare','compareAttribute' => 'password' ],
        				['confirmpassword', 'required'],
        		        ['password', 'required'],
        		[['role','username','password','confirmpassword','email'],'safe'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function attributeLabels()
    {
    	return [
    
    			'username' => 'User Name',
    			'email' => 'Email',
    			'password' => 'Password',
    			'confirmpassword' => 'Confirm Password',
    			
    
    	];
    }
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
