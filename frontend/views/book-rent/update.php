<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BookRent $model */

$this->title = 'Update Book Rent: ' . $model->id_book_rent;
$this->params['breadcrumbs'][] = ['label' => 'Book Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_book_rent, 'url' => ['view', 'id_book_rent' => $model->id_book_rent]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-rent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
