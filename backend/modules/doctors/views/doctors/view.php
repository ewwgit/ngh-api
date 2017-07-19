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
//**********************//

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */

$str = $model->name;
$rest = substr($str, 0, 150);

$this->title = $rest;
$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
<div class="container" id="print">
<style>
th {
	display: none;
}
</style>
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px;">			   
			<div class="panel panel-info">		
					<div class="col-md-8">	
						<div class="box4" style="float: left;">
						<div class="right">Doctor Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->name)){
									echo $model->name;
								}else{
									echo 'Not Mentioned';
								}?></div>
						<div class="right">Unique ID</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->doctorUniqueId; ?></div>
						</div>				
					</div>
					<div class="col-md-4" style="float: left;">
					<?php 
					$usernamedata = User::find()->select(['username','email'])->where(['id'=>$model->userId])->one();
					// print_r($usernamedata);exit;?>
					<?php if($model->doctorImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->doctorImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'doctorImage',
											'format' => 'html',
											'value'=>Html::img($model->doctorImage ? $imgeurl : 'images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		],
        ],
    ]) ?>
					</div>			
          
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">					        
								<div class="right">User Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['username']; ?> </div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['email']; ?> </div>
								
								<div class="right">Qualification</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($docqualiary)){
									echo implode(" , ",$docqualiary);
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Specialities</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($docspeciary)){
									echo implode(" , ",$docspeciary);
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->countryName)){
									echo $model->countryName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->stateName)){
									echo $model->stateName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">City Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->city)){
									echo $model->city;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								
								<div class="right">Present Address</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->address)){
									echo $model->address;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">Permanent Adress</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->permanentAddress)){
									echo $model->permanentAddress;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->pinCode)){
									echo $model->pinCode;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->doctorMobile)){
									echo $model->doctorMobile;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Summery</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->summery)){
									echo $model->summery;;
								}else{
									echo 'Not Mentioned';
								}?></div>

								
								<div class="right">APMC</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->APMC)){
									echo $model->APMC;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">TSMC</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->TSMC)){
									echo $model->TSMC;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
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

