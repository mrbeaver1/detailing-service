<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Review $model */

$this->title = 'Отзыв №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'Номер отзыва',
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Автор отзыва',
                'value' => function ($model) {
                    return $model->user?->surname.' '.$model->user?->name.' '.$model->user?->patronymic;
                }
            ],
            [
                'attribute' => 'text',
                'label' => 'Текст отзыва',
                'format' => 'ntext',
            ],
            [
                'attribute' => 'rating',
                'label' => 'Количество звезд',
            ],
        ],
    ]) ?>

</div>
