<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\DoctorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'doctorid') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'doctorUniqueId') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'qualification') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'stateName') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'countryName') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'pinCode') ?>

    <?php // echo $form->field($model, 'doctorMobile') ?>

    <?php // echo $form->field($model, 'doctorImage') ?>

    <?php // echo $form->field($model, 'summery') ?>

    <?php // echo $form->field($model, 'APMC') ?>

    <?php // echo $form->field($model, 'TSMC') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <?php // echo $form->field($model, 'createdDate') ?>

    <?php // echo $form->field($model, 'updatedDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
