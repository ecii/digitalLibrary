<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\widgets\Pjax; //membuat ajax dalam form
/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'data-pjax'=>'true',
            'id'=>'cover'
        ]
    ]); ?>

<?php
Pjax::begin(['id'=>'cover']); //membuat alarm untuk menolak file
?>
    <?=
    Form::widget([
        'model' => $mUpload,
        'form' => $form,
        'columns' => 2, 
        'attributes' => [
            'cover'=>[
                'label'=>'Book Cover',
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\file\FileInput'
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
