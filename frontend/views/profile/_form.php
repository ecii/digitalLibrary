<?php

use common\models\Job;
use yii\helpers\Html;

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<input type="text" name="name" maxlength="225">-->

    <?php $form = ActiveForm::begin(
        [
            'options'=>[
                'data-pjax'=>'true',
                'id'=>'profile'
            ]
        ]
    ); ?>

<?php
Pjax::begin(['id'=>'profile']); //membuat alarm untuk menolak file
?>
    <?=
    Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3, 
        'attributes' => [
            'name'=>[],
            'email'=>[
                'options'=>['type'=>'email']
            ],
            'phone'=>[
                'options'=>['type'=>'tel']
            ],
            'birthday'=>[
                'options'=>['type'=>'date']],
            'gender'=>[
                'type'=> Form::INPUT_RADIO_LIST,
                'items'=> ['MALE'=>'MALE','FEMALE'=>'FEMALE']
            ],
            'married'=>[
                    'type'=> Form::INPUT_RADIO_LIST,
                    'items'=> ['0'=>'NO','1'=>'YES']
            ],
            'job_id' => [
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=> Select2::className(), 
                'options'=>[
                    'data' => Job::listJob() //buat function untuk menggenerate table
                    ]
            ],
            'address'=>[
                'options'=>['type'=>'text']
            ]


        ]
]);
    
    ?>
<?php
    Pjax::end();
?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
