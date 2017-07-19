<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
$str = $model->name;
$rest = substr($str, 0, 150);
$this->title = 'Update Doctors: ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->doctorid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctors-update">

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
