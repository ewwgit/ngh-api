<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ModulePermissions;
use app\models\UserMain;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModulesMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Permissions > '.$adminusername = UserMain::getUsername($model->id);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-master-index">

   <section class="invoice">
    <h2><?= Html::encode($this->title) ?></h2>

   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        <?php //$id = Yii::$app->request->getParam('id');
       /* $id = Yii::$app->request->get('id');
        echo $id;exit(); */
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

           // 'moduleId',
            'moduleName',
        		['attribute'=>'moduleId',
        		'label' => 'Add',
        		'format' => 'html',
        		'value' => function ($data) {
        		$moduleaccess = ModulePermissions::find()->select(['permissions_add','permissions_all'])->where(['moduleId'=>$data->moduleId,'adminuserId'=>Yii::$app->request->get('id')])->one();
        		if($moduleaccess['permissions_all'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-add','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-add','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_add'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-add','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-add','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_add'] == 0)
        		{
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-add','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-add','moduleId' =>$data->moduleId]);
        			
        		}
        		else {
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-add','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-add','moduleId' =>$data->moduleId]);
        		}
        		
        		return $returnhtml;
        		},
        		],
        		['attribute'=>'moduleId',
        		'label' => 'Edit',
        		'format' => 'html',
        		'value' => function ($data) {
        		$moduleaccess = ModulePermissions::find()->select(['permissions_edit','permissions_all'])->where(['moduleId'=>$data->moduleId,'adminuserId'=>Yii::$app->request->get('id')])->one();
        		if($moduleaccess['permissions_all'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-edit','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-edit','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_edit'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-edit','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-edit','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_edit'] == 0)
        		{
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-edit','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-edit','moduleId' =>$data->moduleId]);
        		}
        		else {
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-edit','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-edit','moduleId' =>$data->moduleId]);
        		}
        		
        		return $returnhtml;
        		},
        		],
        		['attribute'=>'moduleId',
        		'label' => 'Delete',
        		'format' => 'html',
        		'value' => function ($data) {
        		$moduleaccess = ModulePermissions::find()->select(['permissions_delete','permissions_all'])->where(['moduleId'=>$data->moduleId,'adminuserId'=>Yii::$app->request->get('id')])->one();
        		if($moduleaccess['permissions_all'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-delete','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-delete','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_delete'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-delete','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-delete','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_delete'] == 0)
        		{
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-delete','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-delete','moduleId' =>$data->moduleId]);
        		}
        		else {
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-delete','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-delete','moduleId' =>$data->moduleId]);
        		}
        		
        		return $returnhtml;
        		},
        		],
        		['attribute'=>'moduleId',
        		'label' => 'View',
        		'format' => 'html',
        		'value' => function ($data) {
        		$moduleaccess = ModulePermissions::find()->select(['permissions_view','permissions_all'])->where(['moduleId'=>$data->moduleId,'adminuserId'=>Yii::$app->request->get('id')])->one();
        		if($moduleaccess['permissions_all'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-view','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-view','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_view'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-view','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-view','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_view'] == 0)
        		{
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-view','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-view','moduleId' =>$data->moduleId]);
        		}
        		else {
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-view','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-view','moduleId' =>$data->moduleId]);
        		}
        		
        		return $returnhtml;
        		},
        		],
        		['attribute'=>'moduleId',
        		'label' => 'Full',
        		'format' => 'html',
        		'value' => function ($data) {
        		$moduleaccess = ModulePermissions::find()->select(['permissions_all'])->where(['moduleId'=>$data->moduleId,'adminuserId'=>Yii::$app->request->get('id')])->one();
        		if($moduleaccess['permissions_all'] == 1)
        		{
        			$returnhtml = Html::a('<i class="fa fa-check"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-all','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-all','moduleId' =>$data->moduleId]);
        		}
        		else if($moduleaccess['permissions_all'] == 0)
        		{
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-all','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-all','moduleId' =>$data->moduleId]);
        		}
        		else {
        			$returnhtml = Html::a('<i class="fa fa-times"></i>', ['adminusers/permissionsupdate', 'permissiontype' => 'permission-all','userid'=>Yii::$app->request->get('id'),'moduleid'=>$data->moduleId], ['class' => 'permission','permission-type' => 'permission-all','moduleId' =>$data->moduleId]);
        		}
        		
        		return $returnhtml;
        		},
        		],
           // 'type',
            //'status',
           // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',
            // 'ipAddress',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</section>
</div>

<?php
//The AJAX request for the Add Another button. It updates the #div-address-form div.
$this->registerJs("
    $(document).on('click', '.permission', function(){
		var permissiontype = $(this).attr('');
		console.log(permissiontype);
		
		var cnt = numItems+1;
        $.ajax({
            url: '" . \Yii::$app->urlManager->createUrl(['user/adminusers/additional']) . "',
            type: 'post',
		    data: { cnt: cnt},
            dataType: 'html',
            success: function(data) {
	
                $('#div-education-form').append(data);
            },
            error: function() {
                alert('An error has occured while adding a new block.');
            }
        });
    });
		
		console.log($model->id);
		
"); ?>
