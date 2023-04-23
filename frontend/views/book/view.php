<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="crd border-primary">
    <div class="card-header">
    <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
       
    <img src="/img/cover/<?=$model->foto;?>" class="img img-thumbnail rounded mx-auto d-block">    
    <hr>
   
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id_book',
            'title',
            'author',
            'publisher',
            'year',
            'description:ntext',
            //'created_at',
            //'created_by',
        ],
    ]) ?>

    <p align="center">
        <?=Html::a('Print',['print','id_book' => $model->id_book],['class' => 'btn btn-info'])?>
        <?= Html::a('Update', ['update', 'id_book' => $model->id_book], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_book' => $model->id_book], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
