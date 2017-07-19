<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form ">

<div class="box box-primary">
	<div class="box-body">  
		<?php $form = ActiveForm::begin(); ?>
		
	            <div class="form-group col-lg-7 col-sm-12">
			    <?= $form->field($model, 'RoleName')->textInput(['maxlength' => true,'onblur' => 'nospaces(this)']) ?>
			    </div>
		    
		       <div class="form-group col-lg-7 col-sm-12">
			   <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
			   </div>
			
			   <div class="form-group col-lg-7 col-sm-12">
			   <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active'], ['prompt' => 'Select Status']) ?>
					 <?php //if(!($model->isNewRecord))
// 					{?>
						<?php // $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active'], ['prompt' => 'Select Status']) ?>
					<?php // }?> 
			   </div>
				
				    <?php // $form->field($model, 'createdDate')->textInput() ?>
				
				    <?php // $form->field($model, 'updatedDate')->textInput() ?>
				
				    <?php // $form->field($model, 'ipAddress')->textInput(['maxlength' => true]) ?>
		
		
		    <div class="form-group col-lg-7 col-sm-12">
		        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>

   		 <?php ActiveForm::end(); ?>

</div>
</div>
</div>

