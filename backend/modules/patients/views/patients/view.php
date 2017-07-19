<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */
$str = $model->firstName;
$rest = substr($str, 0, 150);

$this->title = $rest;
//$this->title = $model->firstName;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-view">
<div class="box box-primary">
<div class="box-body">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->patientId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->patientId], [
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
            
            'firstName',
            'lastName',
            'gender',
            'age',
            'dateOfBirth',
            'patientUniqueId',
            
            'countryName',
            
            'stateName',
            'district',
            'city',
            'mandal',
            'village',
            'pinCode',
            'mobile',
            'createdDate',
            'updatedDate',
        		['attribute'=>'Height',
        		'value' => $patmodel->height,
        		],
        		['attribute'=>'Weight',
        		'value' => $patmodel->weight,
        		],
        		['attribute'=>'Respiration Rate',
        		'value' => $patmodel->respirationRate,
        		],
        		['attribute'=>'BPLeftArm',
        		'value' => $patmodel->BPLeftArm,
        		],
        		['attribute'=>'BPRightArm',
        		'value' => $patmodel->BPRightArm,
        		],
        		['attribute'=>'Pulse Rate',
        		'value' => $patmodel->pulseRate,
        		],
        		['attribute'=>'Temparature',
        		'value' => $patmodel->temparatureType,
        		],
        		['attribute'=>'Diseases',
        		'value' => $patmodel->diseases,
        		],
        		['attribute'=>'AllergicMedicine',
        		'value' => $patmodel->allergicMedicine,
        		],
        		['attribute'=>'PatientCompliant',
        		'value' => $patmodel->patientCompliant,
        		],
        		
        		
        	
        		
        ],
    ]) ?>
    
</div>
</div>
</div>
