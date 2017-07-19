<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */

$this->title = 'Create Patients';
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
