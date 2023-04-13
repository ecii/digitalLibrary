<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Job $model */

$this->title = $model->id_job;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_job' => $model->id_job], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_job' => $model->id_job], [
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
            'id_job',
            'job_name',
            'job_category',
            'pns',
            'description:ntext',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
