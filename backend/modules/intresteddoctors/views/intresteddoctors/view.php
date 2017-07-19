<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\intresteddoctors\models\Intresteddoctors */

 
 $str = $model->name;
 $rest = substr($str, 0, 150);

$this->title = $rest;
$this->params['breadcrumbs'][] = ['label' => 'Intrested Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intresteddoctors-view">

<div class="box box-primary">
<div class="box-body">    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->insdocid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->insdocid], [
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
          //  'insdocid',
            'name',
           // 'email:email',
        		[
        		'attribute'=>'email',
        		'value' => $model->email,
        		//'format' => 'raw',
        		],
           // 'role',
        		['attribute'=>'Role',
        		'value' => $data,
        		],
            'description:ntext',
            'mobile',
           // 'createdDate',
        		[
        		'attribute' => 'createdDate',
        		
        		'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
        ],
    ]) ?>

</div>
</div>
</div>
