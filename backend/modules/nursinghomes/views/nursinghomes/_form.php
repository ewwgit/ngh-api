<?php
namespace  app\modules\nursinghomes\views;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\file\FileInput;
//use kartik\widgets\DepDrop;
/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nursinghomes-form">
<div class="box box-primary">
<div class="box-body">
    <?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
 	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10],['clientOptions' => [ 'clearIncomplete' => true],]) ?>
	</div>
	 <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'landline')->textInput(['maxlength' => 10 ]) ?>
	</div>
	 <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
   	</div>
   	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'nursingHomeName')->textInput(['maxlength' => true]) ?>
   	</div> 
    

       
	<div class="form-group col-lg-6 col-sm-12"> 
    <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?php echo $form->field($model, 'state')->widget(DepDrop::classname(),['data'=>$model->statesData,
    'pluginOptions'=>[
        'depends'=>['nursinghomes-country'],
        'placeholder'=>'Select States',
        'url'=>Url::to(['/nursinghomes/nursinghomes/states'])]]);?>  
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
    <?=$form->field($model, 'status')->dropDownList(['10' => 'Active','0' => 'In-Active'],['prompt' => 'Status'],['itemOptions' => ['class' =>'radio-inline']])?>
	</div> 
	
		<div class="form-group col-lg-6 col-sm-12">
      <?=$form->field ( $model, 'nursingImage' )->widget ( FileInput::classname (),
   		[ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'Profile Image', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )?>     
    </div>
	

	<div class="form-group ">
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