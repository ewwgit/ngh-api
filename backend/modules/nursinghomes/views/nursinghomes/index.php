<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NursinghomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<h1 ><?php $this->title = 'Nursing Homes';?></h1>
<?php 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-index">
<div class="box box-primary">
<div class="box-body">
    <h1><?php //Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursing Homes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'nursingId',
        		//'username',
        		[
        		'label' => 'User Name',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
//         		'email',
           //  'nuserId',
          //  'nurshingUniqueId',
        		[
        		'attribute'=>'nurshingUniqueId',
        		'label' => 'Unique Id',
        		],
            'contactPerson',
            'mobile',
        	//	'countryName',
        	[
        		'attribute'=>'countryName',
        		 'label' => 'Country',
        			],
        	//	'stateName',
        		[
        		'attribute'=>'stateName',
        		'label' => 'State',
        		 
        		],
             'city',
            // 'state',
          
            // 'country',
            
             'pinCode',
//         		[
//         		'label' => 'Status',
//         		'attribute' => 'status',
//         		'value' => 'user.status',
//         		'filter' => Html::activeDropDownList($searchModel, 'status', ['Active' => 'Active','In-active' => 'In-active'],['class'=>'form-control','prompt' => 'Status']),
//         		],

        		//'status',
            // 'address:ntext',
            // 'description:ntext',
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

            ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{password}',
            		'buttons' => [
            				'password' => function ($url,$data) {
            				$url = Url::to(['/nursinghomes/nursinghomes/reset-password','id'=>$data->nuserId]);
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