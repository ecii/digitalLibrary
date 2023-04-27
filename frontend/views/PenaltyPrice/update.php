<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PenaltyPrice $model */

$this->title = 'Update Penalty Price: ' . $model->id_price;
$this->params['breadcrumbs'][] = ['label' => 'Penalty Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_price, 'url' => ['view', 'id_price' => $model->id_price]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penalty-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
