<?php

use common\models\RentRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RentRecordSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rent Records for '.$dataProfile->name; 
// cara menampilkan nama yang sudah dipilih idnya pada controller Data Rent sebelumnya
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=card>
<div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
<div class="card-body">
    

    <p>
        <?= Html::a('Create Rent Record', ['list-profile'], ['class' => 'btn btn-outline-success']) ?>
        
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider, //get smua data
        'filterModel' => $searchModel, // get data yang di butuhkan
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_rent_record',
            // 'profile_id',
            'return_at',
            'rent_status',
            ['attribute'=>'created_at','format'=>'date'],
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'template'=>'{add-book}  {delete}  {view}',
                
                 'buttons'=>[
                    'add-book'=> function($url,$model){
                        return Html::a('List Book',['/book-rent/index','rent_record_id'=>$model->id_rent_record],['class'=>'btn btn-outline-info']);
                    }
                ]                
            ],
        ],
    ]); ?>

</div>
</div>
