<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Review $model */

$this->title = 'Отзыв №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменит отзыв', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить отзыв', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'Номер отзыва',
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
