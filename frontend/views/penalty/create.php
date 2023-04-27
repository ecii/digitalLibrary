<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Penalty $model */

$this->title = 'Create Penalty';
$this->params['breadcrumbs'][] = ['label' => 'Penalties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penalty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
