<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
use app\modules\nursinghomes\models\Nursinghomes;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = $model->nursingId;
$str = $model->nursingHomeName;
$rest = substr($str, 0, 150);

$this->title = $rest;

//$this->title = ' Nursing Homes View';
$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
<div class="container" id="print">
<style>
.doctor-box {
	border: none;
}
th {
	display: none;
}
</style>
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
			<div class="panel panel-info">	
			
			<div class="col-md-8">	
						<div class="box4" style="float: left;">
						
						<div class="right" style=" width: 45%"> Unique ID</div>								
								<div class="right-content" style="  width: 0% ">:</div>
								<div class="right-second" style=" width:37% "><?= $model->nurshingUniqueId; ?></div>
								<div class="right" style=" width: 45%">Nursing Home Name</div>								
								<div class="right-content" style="  width: 0% ">:</div>
								<div class="right-second" style=" width:37% ">
								<?php if($model->nursingHomeName != ''){
									
							    echo 	$model->nursingHomeName;
								}else{
									echo 'Not Mentioned';
								}?></div>
						</div>				
					</div>	
					<div class="col-md-3" style="float: left;">
								
					<?php if($model->nursingImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'nursingImage',
											'format' => 'html',
											'value'=>Html::img($model->nursingImage ? $imgeurl : 'images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		],
        ],
    ]) ?>
					</div>		          
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
					<?php $usernamedata = User::find()->select(['username','email','status'])->where(['id'=>$model->nuserId])->one();?>
  
      
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="nursing-box">					        
															
								
								<div class="right">Contact Person</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if($model->contactPerson != ''){
									
															echo 	$model->contactPerson;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">User Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['username']; ?>
								</div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['email']; ?></div>
								
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->mobile)){
									echo $model->mobile;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">Landline</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->landline)){
									echo $model->landline;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Country</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->countryName)){
									echo $model->countryName;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">State</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->stateName)){
									echo $model->stateName;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">City</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->city)){
									echo $model->city;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->pinCode)){
									echo $model->pinCode;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Address</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->address)){
									echo $model->address;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Description</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->description; ?>
							   </div>
								<div class="right">Status</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if($usernamedata['status']==10){echo"Active";}else {echo"In-Active";} ?></div>
								
									
																 							
							</div><!---doctor-box closed-->							
						</div>	<!---main-wrap closed-->							
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
</div>
<button class="btn btn-primary" onclick="printContent('print')">Print</button>
</div>
</div>
</div>
<style>
.nursing-box{
	width:90%;
	border-bottom:1px solid #f1f2f2;
	padding:0px;
	margin:0px;	
	text-align:left;	
	color: #369;	
}
</style>


