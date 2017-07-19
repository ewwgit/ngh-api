<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

   
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>	
    </div>
    
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">    
    <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>	
    </div>
    
    	
	<div class="form-group">
        <?= Html::submitButton( 'Create' , ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<style>
.help-block {
    height: 5px;
}
</style>