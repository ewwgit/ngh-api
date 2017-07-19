<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = 'Update Nursings: ' . $model->nursingId;
$str = $model->nursingHomeName;
$rest = substr($str, 0, 150);
$this->title = 'Update Nursing Homes: ' . $rest;

$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->nursingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursinghomes-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
