<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nursinghomes-form">
<div class="box box-primary">
<div class="box-body">
     <?php $form = ActiveForm::begin( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		] ]); ?>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readOnly' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'landline')->textInput(['maxlength' => 10]) ?>
	</div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readOnly' => true]) ?>
   	</div>
   	
   		<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'nursingHomeName')->textInput(['maxlength' => true]) ?>
   	</div>  
 
    
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?php
      echo $form->field($model, 'state')->widget(DepDrop::classname(),[
                    		'data'=>$model->statesData,
    'pluginOptions'=>[
        'depends'=>['nursinghomes-country'],
        'placeholder'=>'Select States',
        'url'=>Url::to(['/nursinghomes/nursinghomes/states'])
    ]
]);
  
 ?>  
   	</div>
   	<div class="form-group col-lg-6 col-sm-12">
   <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
	</div>
	
	 
	
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
	</div>
	  	<div class="form-group col-lg-6 col-sm-12">   
    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => 8]) ?>
	</div>
	
	
		<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
   	</div>
   	
   		
   	<div class="form-group col-lg-6 col-sm-12">
    <?=$form->field($model, 'status')->dropDownList(['10' => 'Active','0' => 'In-Active'],['prompt' => 'Status'],
											['itemOptions' => ['class' =>'radio-inline']])?>
	</div> 
	
	
	<div class="form-group col-lg-6 col-sm-12">
    <?php if($model->nursingImage != ''){?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;?>

						 		
						 		<?php  }
						 		// print_r($imgeurl);exit;?>
						<img class='image' 
							src="<?php
							if($model->nursingimageupdate)
							{
								
								echo isset( $model->nursingimageupdate)? Url::base().'/'.$model->nursingimageupdate : '' ;
							
							}else {
									 echo Url::base()."/images/user-iconnew.png" ;
								      }
								?>"
							width="100" height="100"> </img> 
							 <?=$form->field ( $model, 'nursingImage' )->widget ( FileInput::classname (), [ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'doctorImage', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )?>
            <?= $form->field($model, 'nursingimageupdate')->hiddenInput()->label(false); ?>
            
        
	</div>     

   
	
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
<style>
.help-block {
    height: 5px;
}
</style>