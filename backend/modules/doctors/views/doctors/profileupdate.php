<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */

$this->title = 'Update Doctors: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['profileview', 'uid' => $model->userId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctors-update">

    <?= $this->render('p_updateform', [
        'model' => $model,
    ]) ?>

</div>
