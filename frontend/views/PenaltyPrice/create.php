<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PenaltyPrice $model */

$this->title = 'Create Penalty Price';
$this->params['breadcrumbs'][] = ['label' => 'Penalty Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penalty-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
