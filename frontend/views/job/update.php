<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Job $model */

$this->title = 'Update Job: ' . $model->id_job;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_job, 'url' => ['view', 'id_job' => $model->id_job]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
