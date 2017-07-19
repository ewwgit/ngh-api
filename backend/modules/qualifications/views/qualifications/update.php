<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\qualifications\models\Qualifications */
$str = $model->qualification;
$rest = substr($str, 0, 150);
$this->title = 'Update Qualifications: ' .$rest;
$this->params['breadcrumbs'][] = ['label' => 'Qualifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->qlid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qualifications-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
