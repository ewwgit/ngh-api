<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\intrestednursinghomes\models\Intrestednghs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intrestednghs-form">
<div class="box box-primary">
<div class="box-body">
    <?php $form = ActiveForm::begin(); ?>
<div class="form-group col-lg-6 ">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group col-lg-6 ">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group col-lg-6 ">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10]) ?>
    </div>
<div class="form-group col-lg-6 ">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
    <?php // $form->field($model, 'createdDate')->textInput() ?>

<div class="form-group col-lg-6">
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

