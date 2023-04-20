<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>


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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
