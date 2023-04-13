<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\BookRent $model */

$this->title = $model->id_book_rent;
$this->params['breadcrumbs'][] = ['label' => 'Book Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-rent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_book_rent' => $model->id_book_rent], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_book_rent' => $model->id_book_rent], [
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
            'id_book_rent',
            'rent_record_id',
            'book_id',
            'created_at',
            'created_by',
        ],
    ]) ?>

</div>
