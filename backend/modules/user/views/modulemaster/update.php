<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesMaster */
$str = $model->moduleName;
$rest = substr($str, 0, 150);
$this->title = 'Update Modules : ' . $rest;
$this->params['breadcrumbs'][] = ['label' => 'Modules ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rest, 'url' => ['view', 'id' => $model->moduleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modules-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
