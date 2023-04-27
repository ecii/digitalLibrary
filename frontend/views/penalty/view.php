<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Penalty $model */

$this->title = $model->id_penalty;
$this->params['breadcrumbs'][] = ['label' => 'Penalties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penalty-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_penalty' => $model->id_penalty], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_penalty' => $model->id_penalty], [
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
            'id_penalty',
            'price_id',
            'charge',
            'duration',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
