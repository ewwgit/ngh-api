<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
        		'nursingHomeName',
        		'firstName',
        		'lastName',
        		//'patientRequestStatus',
        		[
        		'attribute' => 'patientRequestStatus',
        		'value' => 'patientRequestStatus',
        		'filter' => Html::activeDropDownList($searchModel, 'patientRequestStatus', ['PROCESSING' => 'PROCESSING','COMPLETED' => 'COMPLETED'],['class'=>'form-control','prompt' => 'Status']),
        		],

             ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} ',
             		'buttons' => [
             				'view' => function ($url,$data) {
             				$url = Url::to(['/doctors/doctors/patient-info','phsId'=>$data->patientHistoryId]);
             				return Html::a(
             						'<span class="glyphicon glyphicon-eye-open"></span>',
             						$url);
             				},
             		
             				],
            		
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>
