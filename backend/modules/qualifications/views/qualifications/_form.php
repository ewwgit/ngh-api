<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\qualifications\models\Qualifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qualifications-form">
<div class="box box-primary">
<div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

	<div class="form-group col-lg-7 ">
    <?= $form->field($model, 'qualification')->textInput(['maxlength' => 100]) ?>
	</div>
	<div class="form-group col-lg-7 ">
    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Status']) ?>
	</div>
	
    <div class="form-group col-lg-7">
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