<?php

use common\models\Book;
use common\models\PenaltyPrice;
use yii\helpers\Html;

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var common\models\BookRent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-rent-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php  
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1, 
        'attributes' => [
              'book_id' => [
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=> Select2::className(), 
                'options'=>[
                    'data' => Book::listBook() //buat function untuk menggenerate table
                    ]
                ],
                'penalty_id'=>[
                    'type'=> Form::INPUT_WIDGET,
                    'widgetClass'=> Select2::className(), 
                    'options'=>[
                        'data' => PenaltyPrice::listPenaltyPrice() //buat function untuk menggenerate table
                        ]
                ],
        ]
]);?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
