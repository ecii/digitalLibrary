<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RentRecord $model */

$this->title = $model->id_rent_record;
$this->params['breadcrumbs'][] = ['label' => 'Rent Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rent-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_rent_record' => $model->id_rent_record], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_rent_record' => $model->id_rent_record], [
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
            'id_rent_record',
            'profile_id',
            'return_at',
            'rent_status',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
