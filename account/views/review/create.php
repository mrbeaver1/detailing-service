<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Review $model */

$this->title = 'Добавить отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Мои отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
