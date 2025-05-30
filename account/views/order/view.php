<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = 'Запись №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить запись', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
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
                'label' => 'Номер записи',
            ],
            [
                'attribute' => 'client_id',
                'label' => 'Клиент',
                'value' => function ($model) {
                    return $model->client?->surname . ' ' . $model->client?->name . ' ' . $model->client?->patronymic;
                }
            ],
            [
                'attribute' => 'car_id',
                'label' => 'Автомобиль',
                'value' => function ($model) {
                    return $model->car?->name;
                }
            ],
            [
                'attribute' => 'service_id',
                'label' => 'Услуга',
                'value' => function ($model) {
                    return $model->service?->name;
                }
            ],
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function ($model) {
                    return $model->orderStatus?->name;
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'personal_price',
                'label' => 'Цена с учетом скидки',
                'value' => function ($model) {
                    return $model->personal_price ? "$model->personal_price р."  : '-';
                }
            ],
        ],
    ]) ?>

</div>
