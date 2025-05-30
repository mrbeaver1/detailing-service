<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Review $model */

$this->title = 'Изменение отзыва №:' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение отзыва';
?>
<div class="review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
