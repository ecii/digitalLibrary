<?php

use common\models\Book;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var common\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_book',
            'title',
            'author',
            'publisher',
            'year',
            //'description:ntext',
            //'created_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{update}  {cover}',
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_book' => $model->id_book]);
                 },
                 'buttons'=>[
                    'update'=>function($url,$model){
                        return Html::a('Update',[$url],['class'=>'btn btn-warning btn sm']);
                    },
                    'cover'=>function($url,$model){
                        return Html::button('Upload Cover',['value'=>$url, 'class'=>'btn btn-info btn sm btn-pop']);
                    }
                ]
            ],
        ],
    ]); ?>

    </div>
</div>


<?php
Modal::begin([
    'id' => 'modalPopUp',
    'size' => 'modal-lg',
    'class' => 'modal fade',
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss'=>'modal'
    ]
]);

echo'<div id="modalContent"></div>';

$this->registerJs("
    $(function(){
        $('.btn-pop').on('click',function(){
            $('#modalPopUp').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    })
});
    ");
?>
