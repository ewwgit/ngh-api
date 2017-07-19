<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
$str = $model->RoleName;
$rest = substr($str, 0, 150);

$this->title = $rest;

//$this->title = $model->RoleName;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">
<div class="box box-primary">
<div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'RoleName',
            'status',
            'description:ntext',
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
