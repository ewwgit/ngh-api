<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */
$str = $model->username;
$rest = substr($str, 0, 150);
$this->title = 'Update Admin User: '. $str;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$str, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
