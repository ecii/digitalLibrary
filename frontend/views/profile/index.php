<?php

use Codeception\Util\Template;
use common\models\Profile;
use kartik\export\ExportMenu;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;




/** @var yii\web\View $this */
/** @var common\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        $tableExport=[
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'phone',
            'birthday',
            'gender',
            'married',
            [
                'label' => 'Job Name',
                'value' => 'myJob.job_name' //job = nama function yg ada di profile.php dan job_name adalah field di db
                
            ],
            'address:ntext',
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
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_profile',
            'name',
            'email:email',
            'phone',
            'birthday',
            'gender',
            'married',
            [
                'label' => 'Job Name',
                'value' => 'myJob.job_name' //job = nama function yg ada di profile.php dan job_name adalah field di db
                
            ],
            'address:ntext',
            //'created_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{update}  {upload}  {view}',
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_profile' => $model->id_profile]);
                 },
                 'buttons'=>[
                    'update'=>function($url,$model){
                        return Html::a('<span class="fa fa-edit"></span>  Update',[$url],['class'=>'btn btn-warning btn sm']);
                    },
                    'upload'=>function($url,$model){
                        return Html::button('<span class="fa fa-upload"></span> Upload Foto',['value'=>$url, 'class'=>'btn btn-info btn sm btn-pop']);
                    },
                    'view'=>function($url,$model){
                        return Html::a('<span class="fa fa-eye"></span>  Detail',[$url],['class'=>'btn btn-primary']);
                    }
                ]
            ],
        ],
    ]); ?>


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
