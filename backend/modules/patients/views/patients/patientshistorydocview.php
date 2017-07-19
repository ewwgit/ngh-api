<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */

$this->title = $patmodel->firstName;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
<div class="box-body">
<div class="doctors-view">
<div class="container" id="print">
<style>
th {
	display: none;
}
h3 {
	margin-top:0px;
	padding-left: 15px;
}
</style>

    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
			<div class="panel panel-info">		
					
					
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
					   <h3>Patient Information</h3>
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">
							<div class="right">Patient Image</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if($patmodel->patientImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$patmodel->patientImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $patmodel,
							'attributes' => [
									[
											'attribute'=>'patientImage',
											'format' => 'html',
											'value'=>Html::img($patmodel->patientImage ? $imgeurl : 'images/user-iconnew.png',['width' => '200px','height' => '150px']),
        		],
        ],
    ]) ?></div>
								
							<div class="right">Patient Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $patmodel->firstName; ?>&nbsp;<?= $patmodel->lastName; ?></div>
								
								<div class="right">PatientUnique ID</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $patmodel->patientUniqueId; ?></div>
													        
								<div class="right">Gender</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $patmodel->gender; ?></div>
								
								<div class="right">Age</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $patmodel->age ?> </div>
								
								
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->countryName)){
									echo $patmodel->countryName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->stateName)){
									echo $patmodel->stateName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">City Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($patmodel->city)){
									echo $patmodel->city;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								
								<div class="right">District</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->district)){
									echo $patmodel->district;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">Mandal</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->mandal)){
									echo $patmodel->mandal;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Village</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->village)){
									echo $patmodel->village;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								 
									<?= $patmodel->pinCode;?></div>
									
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								 
									<?= $patmodel->mobile;?></div>
								
						    </div> <!---doctor-box closed-->
						    </div>	<!---main-wrap closed-->
						    <?php 
						    $cdate = $patmodel->createdDate;
						    $yrdata= strtotime($cdate);
						    $yeardata= date('d-M-Y', $yrdata);
						    
						    ?>
						    
						    		 <h3>Previous Information on <?php echo $yeardata ?></h3>
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">
									
									
								
								
								<div class="right">Height</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->height)){
									echo $model->height;;
								}else{
									echo 'Not Mentioned';
								}?></div>

								
								<div class="right">Weight</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->weight)){
									echo $model->weight;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Respiration Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->respirationRate)){
									echo $model->respirationRate;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								<div class="right">BP Left Arm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->BPLeftArm; ?></div>
								
								<div class="right">BP Right Arm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->BPRightArm; ?></div>
													        
								<div class="right">Pulse Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->pulseRate; ?></div>
								
								<div class="right">Temparature</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $model->temparatureType; ?> </div>
								
								<div class="right">Diseases</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->diseases; ?></div>
													        
								<div class="right">Allergic Medicine</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->allergicMedicine; ?></div>
								
								<div class="right">Patient Compliant</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $model->patientCompliant; ?> </div>
								
								
								
																 							
							  </div> <!---doctor-box closed-->
						    </div>	<!---main-wrap closed-->
						    <h3>Patient Documents Information</h3>
						
						    
						    <?php if(!empty($docary)){
						    	for($k=0;$k< count($docary);$k++)
						    	{
						    		$extpos = strpos($docary[$k],'.');
						    		$exten = substr($docary[$k],$extpos+1);
						    		$imageary = ['jpg','png','gif'];
						    		if(in_array($exten,$imageary))
						    		{
						    			$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).'images/pic_img.png';
						    		
						    		}
						    		elseif($exten == 'pdf')
						    		{
						    			$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).'images/pdf_img.png';
						    		}
						    		elseif ($exten == 'doc')
						    		{
						    			$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).'images/doc_img.png';
						    		}
						    		else{
						    			$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).'images/pic_img.png';
						    		}
						    		?>
						    		<div style="width:90px; height:90px; border:1px solid #ddd; margin-left: 15px;"><a href="<?php echo str_replace("frontend","backend",Yii::getAlias('@web/')).$docary[$k];?>" target="_blank"><img style="padding-left: 12px; padding-top: 12px;" src="<?php echo $imgeurl; ?>" /></a></div>
						    		<?php 
						    		
						    	}
									?>
									<?php 
								}else{
									echo 'Not Mentioned';
								}
								?>
																			
												
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
</div>
</div>
</div>
</div>
