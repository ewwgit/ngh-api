<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\intrestednursinghomes\models\Intrestednghs */
$str = $model->name;
$rest = substr($str, 0, 150);
$this->title = 'Update Interested Nursing Homes: ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Interested Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->insnghid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intrestednghs-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
