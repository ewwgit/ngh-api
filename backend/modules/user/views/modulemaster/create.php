<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModulesMaster */

$this->title = 'Create Modules ';
$this->params['breadcrumbs'][] = ['label' => 'Modules ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
