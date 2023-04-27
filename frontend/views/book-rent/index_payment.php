<?php

use common\models\BookRent;
use common\models\Book;
use common\models\Penalty;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BookRentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Book Rents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-success">
<div class="card-header">
    <h3><?= Html::encode($this->title) ?></h3>
</div>
    
<div class="card-body">
    <p>
        <?= 
        // yang dilempar oleh itu rent record id ke page book-rent/create.php
        // yang sebelumnya id tersebut diterima dari bookrentcontroller 
        Html::a('Pay', ['penalty/payment','rent_record_id' => $rent_record_id], ['class' => 'btn btn-success']) ?>
        <?=Html::a('Back', ['rent-record/index'], ['class' => 'btn btn-success']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'array_book'=>$array_book,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_book_rent',
            //'rent_record_id',
            
            [
                'label'=>'Judul Buku',
                'value'=>'book.title'
            ],//nama buku
            [
                'label'=>'Tgl Pinjam',
                'format'=>'date',
                'value'=>'rentRecord.created_at'
            ],
            [
                'label'=>'Tgl Kembali',
                'format'=>'date',
                'value'=>'rentRecord.return_at'
            ],
            [
                'label'=>'Lama Denda',
                'value'=>'penalty.duration'
            ],
            [
                'label'=>'Total Tagihan',
                'value'=>'penalty.charge'
            ],
            // 'created_by',
            [
                'class' => ActionColumn::className(),
                'template'=>'{delete}',
                'urlCreator' => function ($action, BookRent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_book_rent' => $model->id_book_rent]);
                 }
            ],
        ],
    ]); ?>
</div>
</div>
