<?php

use Codeception\Step\Action;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\RentRecord;
use function PHPSTORM_META\type;

/** @var yii\web\View $this */
/** @var common\models\RentRecord $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rent-record-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'return_at')->textInput(['type'=>'date']) ?>
    <div class="form-group">

    <?= Html::submitButton('Save', ['class' => 'btn btn-outline-info']) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>
