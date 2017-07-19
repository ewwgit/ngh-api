<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = 'Update Nursings: ' . $model->nursingId;
$this->title = 'Update Nursing Homes';
//$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['view', 'id' => $model->nursingId]];
$this->params['breadcrumbs'][] = ['label' => $model->contactPerson, 'url' => ['profileview', 'uid' => $model->nuserId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursinghomes-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('p_updateform', [
        'model' => $model,
    ]) ?>

</div>
