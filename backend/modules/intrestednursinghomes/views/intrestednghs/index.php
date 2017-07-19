<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\intrestednursinghomes\models\IntrestednghsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interested Nursing Homes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intrestednghs-index">
<div class="box box-primary">
<div class="box-body">
    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Interested Nursing Homes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //'insnghid',
            'name',
            'email',
//         		[
//         				'attribute' =>'email',
//         				'value' => $searchModel->email,
//         		],
       //     'role',
//         		[
        		
//         		'attribute'=>'role',
//         		//'filter'=> $searchData =ArrayHelper::map(Role::find()->select(['RoleId','RoleName'])->where(('RoleId < 3'))->asArray()->all(), 'RoleId', 'RoleName'),
        	//$form->field($model, 'center_id')->dropDownList($dataList, ['prompt'=>'-Choose a Course-'])
//         		'value' => function ($data) {
//         			$roleData = Role::find()->where(['RoleId' => $data->role])->one();
//         			return $roleData->RoleName;
//         		},
        		 
//         		],
           // 'description:ntext',
            // 'mobile',
            // 'createdDate',

            ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{convert}',
            		'buttons' => [
            				'convert' => function ($url,$data) {
            				$url = Url::to(['/intrestednursinghomes/intrestednghs/convert-nursinghomes','id'=>$data->insnghid]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-arrow-right"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>

