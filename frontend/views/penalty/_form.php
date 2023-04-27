<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Penalty $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="penalty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price_id')->textInput() ?>

    <?= $form->field($model, 'charge')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
