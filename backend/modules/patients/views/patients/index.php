<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\patients\models\PatientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-index">
<div class="box box-primary">
<div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patients', ['patientshistorycreate'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        		'patientUniqueId',
            'firstName',
            'lastName',
            'gender',
            'age',
            // 'dateOfBirth',
            // 'patientUniqueId',
            // 'country',
            // 'countryName',
            // 'state',
            // 'stateName',
            // 'district',
            // 'city',
            // 'mandal',
            // 'village',
            // 'pinCode',
            // 'mobile',
            // 'createdDate',
            // 'updatedDate',

           ['class' => 'yii\grid\ActionColumn',
            		'template' => ' {update} {delete}',
            		'buttons' => [
            				'update' => function ($url,$data) {
            				$url = Url::to(['/patients/patients/patientshistorycreate','id'=>$data->patientUniqueId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-pencil"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>