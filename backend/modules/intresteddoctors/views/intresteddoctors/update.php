<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\intresteddoctors\models\Intresteddoctors */
$str = $model->name;
$rest = substr($str, 0, 150);
$this->title = 'Update Interested Doctors: ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Intrested Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->insdocid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intresteddoctors-update">
  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
