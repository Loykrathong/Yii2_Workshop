<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country_Model */

$this->title = 'Search';
$this->params['breadcrumbs'][] = ['label' => 'Country Search', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country--model-search">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $model]) ?>

</div>
