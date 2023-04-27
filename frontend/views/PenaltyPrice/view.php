<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PenaltyPrice $model */

$this->title = $model->id_price;
$this->params['breadcrumbs'][] = ['label' => 'Penalty Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penalty-price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_price' => $model->id_price], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_price' => $model->id_price], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_price',
            'price_tag',
            'status',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
