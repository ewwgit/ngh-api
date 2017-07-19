<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */
$str = $model->firstName;
$rest = substr($str, 0, 150);

$this->title = 'Update Patients: ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $rest]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patients-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
