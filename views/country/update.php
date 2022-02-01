<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country_Model */

$this->title = 'Update Country  Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Country  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
