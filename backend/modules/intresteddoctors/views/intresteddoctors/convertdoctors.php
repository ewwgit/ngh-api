<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */


$this->title = 'Create Doctors';

$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// Html::encode($this->title)
?>
<div class="nursinghomes-create">

    <h1> </h1>

    <?= $this->render('_doctorsform', [
        'model' => $model,
    ]) ?>

</div>
