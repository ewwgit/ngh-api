<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\intresteddoctors\models\Intresteddoctors */

$this->title = 'Create Interested Doctors';
$this->params['breadcrumbs'][] = ['label' => 'Interested Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intresteddoctors-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
