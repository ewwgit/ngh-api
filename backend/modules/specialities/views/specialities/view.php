<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\nursinghomes\models\Nursinghomes;

/* @var $this yii\web\View */
/* @var $model app\modules\specialities\models\Specialities */
$str = $model->specialityName;
$rest = substr($str, 0, 150);

$this->title = $rest;
//$this->title = $model->specialityName;
$this->params['breadcrumbs'][] = ['label' => 'Specialities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialities-view">
<div class="box box-primary">
<div class="box-body">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->spId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->spId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'spId',
            'specialityName',
            'specialityCode',
            'description:ntext',
            'status',
              [
        		'attribute' => 'createdBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->createdBy),
        		],
        		
        		[
        		'attribute' => 'updatedBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->updatedBy),
        		],
            //  'createdDate',
        		[
        		'attribute' => 'createdDate',
        		
        		'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
            //'updatedDate',
        		[
        		'attribute' => 'updatedDate',
        		
        		'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
        ],
    ]) ?>
</div>
</div>
</div>
