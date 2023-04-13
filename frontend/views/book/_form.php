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
        'model' => $model,
        'form' => $form,
        'columns' => 2, 
        'attributes' => [
            'title'=>
                ['options' => ['placeholder'=>'Full Title']],
            'author' =>
                ['options' => ['placeholder'=>'Author\'s Full Name']],
            'publisher' =>
                ['options' => ['placeholder'=>'Publisher\'s Full Name']],
            'year' =>
                ['options' => ['type'=>'number','min'=>'1900']],
        ]
            
]);
    
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
