<?php

use common\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var account\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="card-header account-card-header d-flex justify-content-between align-items-center">
    <span><?= Html::encode($this->title) ?></span>

        <?= Html::a('Записаться', ['create'], ['class' => 'btn btn-sm btn-light']) ?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card-body">
        <div class="table-responsive">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}\n{summary}",
        'columns' => [
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
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
        </div>
    </div>


</div>
