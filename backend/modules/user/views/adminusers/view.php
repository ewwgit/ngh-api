<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */
$str = $model->username;
$rest = substr($str, 0, 150);

$this->title = $rest;
//$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-master-view">  
<div class="box box-primary">
<div class="box-body">
     <?php if($model->status == 10){
    $status = 'Active';
    }
    else {
    	$status = 'In-Active';
    }?>
    <?php //print_r($model->role); ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
           // 'email:email',
        		[
        		'attribute'=>'email',
        		'value' => $model->email,
        		//'format' => 'raw',
        		],
            'firstName',
            'lastName',
        	'phoneNumber',
        	'address',
        	'idproofs',
        	
           // 'role.RoleName',
        		['attribute'=>'RoleName',
        		//'label' => 'Role Name',
        		'value' => $data,
        		],
        		[
        		'attribute'=>'status',
        		'value'=> $status,
        		],
        		['attribute'=>'profileImage',
        		'format' => 'html',
        		'value'=>Html::img($model->profileImage ? $model->profileImage : '@web',['width' => '150px']),
        		
        		],

        		 
           
           // 'createdBy',
           // 'updatedBy',
        ],
    ]) ?>
</div>
</div>
</div>
