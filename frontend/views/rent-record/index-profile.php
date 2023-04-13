<?php

use common\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Member Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
<div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
    <div class="card-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,//get dengan variabel
        'filterModel' => $searchModel,//get dengan variabel
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],//kayak mysqli_fetch_array yang nampilin data

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
                'template'=>'{create}',// tamplate baru /tombol baru
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_profile' => $model->id_profile]);
                 },
                'buttons'=>[
                    'create'=> function($url){
                        return Html::a('New Record',[$url],['class'=>'btn btn-outline-info']);
                    }
                ]
            ],
        ],
    ]); ?>

    </div>    
</div>


