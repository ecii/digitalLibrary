<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\Job $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=
    Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3, //MEMBUAT KOLOM MENJADI 2 DI DALAM SITE
        'attributes' => [
            'job_name' => [
                'options'=>['placeholder'=>'Enter Job Name']
            ],
            'job_category' => [
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=> Select2::className(), // KARNA PERBEDAAN VERSI DALAM PHP
                'options'=>[
                    'data' => ['WIRAUSAHA' => 'WIRAUSAHA','PEGAWAI'=>'PEGAWAI']
                    ]
            ],
            'pns'=> [
                'type'=> Form::INPUT_RADIO_LIST,
                'items'=>['0'=>'Tidak','1'=>'Ya']
                
            ]
]
]);
    
    ?>
    
   
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
