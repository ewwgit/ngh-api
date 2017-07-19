<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use app\models\AdminMaster;
use app\modules\nursinghomes\models\Nursinghomes;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesMaster */
$str = $model->moduleName;
$rest = substr($str, 0, 150);

$this->title = $rest;
//$this->title = $model->moduleName;
$this->params['breadcrumbs'][] = ['label' => 'Modules ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($model->createdBy);exit;
?>
<div class="modules-master-view">
<div class="box box-primary">
<div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'moduleId',
            'moduleName',
            //'type',
            'status',
            
        		 [
        		'attribute' => 'createdBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->createdBy),
        		],
        		
        		[
        		'attribute' => 'updatedBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->updatedBy),
        		],
        		
        		[
        				'attribute' => 'createdDate',
        		
        				'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
        		[
        				'attribute' => 'updatedDate',
        		
        				'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
        		
            'ipAddress',
        ],
    ]) ?>
</div>
</div>
</div>
