<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country_Model */

$this->title = 'Create Country Model';
$this->params['breadcrumbs'][] = ['label' => 'Country  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
