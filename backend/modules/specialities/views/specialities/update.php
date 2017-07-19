<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\specialities\models\Specialities */
$str = $model->specialityName;
$rest = substr($str, 0, 150);
$this->title = 'Update Specialities: ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Specialities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->spId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specialities-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
