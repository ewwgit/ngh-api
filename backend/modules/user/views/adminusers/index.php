<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\Role;
use app\models\AdminMaster;
use app\models\UserMain;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-master-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php  ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    		//'data' => $data,
    		        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
        		'attribute'=>'username',
        		'label'=>'User Name',
        		'format'=>'text',
        	],
            [
    		'attribute'=>'email',
    		'value' =>'email',
    		    		 ],
      
    		[
    		
    		 'attribute'=>'role',
             'filter'=> Html::activeDropDownList($searchModel, 'role',ArrayHelper::map(Role::find()->select(['RoleId','RoleName'])->where(('RoleId > 3'))->asArray()->all(), 'RoleId', 'RoleName'),['class'=>'form-control','prompt'=>'Select User']),
    	      'value' => function ($data) { 
    		   $roleData = Role::find()->where(['RoleId' => $data->role])->one();
    		       return $roleData->RoleName;
    		        },
    		        	
    		       ],
    		    
    		
        		[
        		'attribute'=>'status',
        		'label'=>'status',
        		'filter' => Html::activeDropDownList($searchModel, 'status', ['Active' => 'Active','In-active' => 'In-active'],['class'=>'form-control','prompt' => 'Status']),
        		'value' => function($data)
        				{
        			if($data->status == 10)
        			{
        				$status = 'Active';
        			 }
        			else
        			{
        				$status = 'In-Active';
        			}
        			return $status;
        		}
        		],
           // 'password_reset_token',
            //'auth_key',
            // 'email:email',
            // 'firstName',
            // 'lastName',
            // 'profileImage:ntext',
            // 'roleId',
            // 'status',
            // 'createdDate',
            // 'updatedDate',
            // 'createdBy',
            // 'updatedBy',

            ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{permissions}',
            		'buttons' => [
            				'permissions' => function ($url,$data) {
            				$url = Url::to(['/user/adminusers/permissions','id'=>$data->id]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-user"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>
