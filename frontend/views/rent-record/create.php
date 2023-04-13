<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RentRecord $model */

$this->title = 'Create Rent Record';
$this->params['breadcrumbs'][] = ['label' => 'Rent Records', 'url' => ['index']]; //buat bikin link urlnya
$this->params['breadcrumbs'][] = $this->title;//untuk judul dari halaman
?>
<div class="card border-info">
<div class="card-header">
    <h3><?= Html::encode($this->title) ?></h1>
</div>
    <div class="card-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
