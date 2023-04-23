<?php

use common\models\Book;
use kartik\export\ExportMenu;
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
    <?php
        $tableExport=[
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'author',
            'publisher',
            'year',
            'description:ntext'
        ];

       echo ExportMenu::widget([
            'dataProvider'=>$dataProvider,
            'columns'=>$tableExport,
            'filename'=>'BooksData',
            'exportConfig'=>[
                ExportMenu::FORMAT_CSV=>false,
                ExportMenu::FORMAT_EXCEL=>false,
                ExportMenu::FORMAT_HTML=>false,
                ExportMenu::FORMAT_TEXT=>false

            ]
        ]);
        ?>
    <p>
        <?= Html::a('<span class="fa fa-plus"></span>  Create Book', ['create'], ['class' => 'btn btn-outline-success']) ?>
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
                'template' => '{update}  {cover}  {view}',
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_book' => $model->id_book]);
                 },
                 'buttons'=>[
                    'update'=>function($url,$model){
                        return Html::a('<span class="fa fa-edit"></span>  Update',[$url],['class'=>'btn btn-warning btn sm']);
                    },
                    'cover'=>function($url,$model){
                        return Html::button('<span class="fa fa-upload"></span> Upload Cover',['value'=>$url, 'class'=>'btn btn-info btn sm btn-pop']);
                    },
                    'view'=>function($url,$model){
                        return Html::a('<span class="fa fa-eye"></span>  Detail',[$url],['class'=>'btn btn-primary']);
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
