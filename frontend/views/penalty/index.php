<?php

use common\models\Penalty;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PenaltySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Penalties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penalty-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Penalty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_penalty',
            'price_id',
            'charge',
            'duration',
            'created_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Penalty $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_penalty' => $model->id_penalty]);
                 }
            ],
        ],
    ]); ?>


</div>
