<?php

use common\models\PenaltyPrice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PenaltyPriceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Penalty Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penalty-price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Penalty Price', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_price',
            'price_tag',
            'status',
            'created_at',
            'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PenaltyPrice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_price' => $model->id_price]);
                 }
            ],
        ],
    ]); ?>


</div>
