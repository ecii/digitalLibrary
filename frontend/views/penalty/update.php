<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Penalty $model */

$this->title = 'Update Penalty: ' . $model->id_penalty;
$this->params['breadcrumbs'][] = ['label' => 'Penalties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penalty, 'url' => ['view', 'id_penalty' => $model->id_penalty]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penalty-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
