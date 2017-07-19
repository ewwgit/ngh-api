<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doctors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'doctorid',
          //  'userId',
            'doctorUniqueId',
        		[
        		'label' => 'User Name',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
            'name',
            //'qualification:ntext',
            // 'city',
            // 'state',
             'stateName',
            // 'country',
             'countryName',
            // 'address:ntext',
             'pinCode',
             'doctorMobile',
            // 'doctorImage',
            // 'summery:ntext',
            // 'APMC',
            // 'TSMC',
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

             ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{password}',
            		'buttons' => [
            				'password' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/reset-password','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-lock"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>
