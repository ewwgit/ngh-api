<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\specialities\models\Specialities */

$this->title = 'Create Specialities';
$this->params['breadcrumbs'][] = ['label' => 'Specialities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialities-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
