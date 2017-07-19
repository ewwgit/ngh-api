<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\qualifications\models\Qualifications */

$this->title = 'Create Qualifications';
$this->params['breadcrumbs'][] = ['label' => 'Qualifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qualifications-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
