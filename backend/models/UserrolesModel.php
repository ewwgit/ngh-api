<?php
namespace app\models;

use yii;
use yii\base\Component;
/**
 * RolesModel is the model behind the RolesModel.
  *
 */
class UserrolesModel extends Component
{
	public static function getRole()
	{
		if(Yii::$app->user->isGuest)
		{
			return null;
		}
		else {
			$roleId = Yii::$app->user->identity->role;
			
			if($roleId)
			{
				return $roleId;
			}
			return null;
		}
		
	}
}
