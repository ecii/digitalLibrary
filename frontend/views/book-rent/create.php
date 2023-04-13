<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BookRent $model */

$this->title = 'Create Book Rent';
$this->params['breadcrumbs'][] = ['label' => 'Book Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-rent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
