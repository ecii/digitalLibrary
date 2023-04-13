<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RentRecord $model */

$this->title = 'Update Rent Record: ' . $model->id_rent_record.$model->created_at.$model->return_at;
$this->params['breadcrumbs'][] = ['label' => 'Rent Records', 'url' => ['index','id_rent_record' => $model->id_rent_record,'created_at' => $model->created_at,'return_at' => $model->return_at]];
$this->params['breadcrumbs'][] = ['label' => $model->id_rent_record, 'url' => ['view', 'id_rent_record' => $model->id_rent_record,'created_at' => $model->created_at,'return_at' => $model->return_at]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
<div class="card-header">
    <h3><?= Html::encode($this->title) ?></h1>
</div>
    <div class="card-body">
    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>
    </div>
</div>
