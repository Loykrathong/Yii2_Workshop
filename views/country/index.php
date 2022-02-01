<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Country_Model_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Country  Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Country Model', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Search', ['search'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
