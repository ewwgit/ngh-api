<?php
namespace backend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $password;
    public $confirmpassword;
    public $oldPassword;
    public $id;

    /**
     * @var \common\models\User
     */
    private $_user;


   

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','oldPassword','id'], 'safe'],
           // ['password', 'string', 'min' => 6],
        		//[['confirmpassword'], 'compare', 'compareAttribute' => 'password'],
        		//[['password'],'safe'],
        		
        		/* [
        				'confirmpassword',
        				'required',
        		], */
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    
    public function attributeLabels()
    {
    	return [
    			'confirmpassword' => 'Confirm Password',
    			'password' => 'Password',
    			
    	];
    }
    public function resetPassword($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
