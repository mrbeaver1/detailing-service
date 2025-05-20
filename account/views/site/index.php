<?php

use common\models\Order;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Обзор | Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-header">
    <h1><i class="fas fa-tachometer-alt me-2"></i> Обзор</h1>
    <a href="<?= Url::to(['order/create']) ?>" class="btn btn-primary btn-account">
        <i class="fas fa-plus me-1"></i> Новая запись
    </a>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card account-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-calendar-check text-primary mb-3" style="font-size: 2rem;"></i>
                <h3 class="mb-1"><?= $activeBookingsCount ?></h3>
                <p class="text-muted mb-0">Активные записи</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card account-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-car text-success mb-3" style="font-size: 2rem;"></i>
                <h3 class="mb-1"><?= $carsCount ?></h3>
                <p class="text-muted mb-0">Автомобиля</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card account-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-star text-warning mb-3" style="font-size: 2rem;"></i>
                <h3 class="mb-1"><?= $averageRating ?></h3>
                <p class="text-muted mb-0">Средний рейтинг</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card account-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-percentage text-info mb-3" style="font-size: 2rem;"></i>
                <h3 class="mb-1"><?= $discount ?>%</h3>
                <p class="text-muted mb-0">Ваша скидка</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="card account-card mb-4">
    <div class="card-header account-card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-calendar-check me-2"></i> Ближайшие записи</span>
        <a href="<?= Url::to(['order/index']) ?>" class="text-white">Все записи</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $ordersDataProvider = new \yii\data\ArrayDataProvider(['allModels' => $activeBookings]) ?>
            <?= GridView::widget([
                'dataProvider' => $ordersDataProvider,
                'layout' => "{items}\n{pager}",
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
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function($url, $model) {
                                return Html::a('<i class="fas fa-edit"></i>', ['/order/update', 'id' => $model->id], [
                                    'class' => 'btn btn-sm btn-outline-primary me-1',
                                    'title' => 'Редактировать'
                                ]);
                            },
                            'delete' => function($url, $model) {
                                return Html::a('<i class="fas fa-times"></i>', ['/order/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'title' => 'Отменить запись'
                                ]);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<!-- Cars -->
<div class="card account-card">
    <div class="card-header account-card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-car me-2"></i> Мои автомобили</span>
        <?= Html::a('Добавить', ['/car/create'], ['class' => 'btn btn-sm btn-light']) ?>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($cars as $car): ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-car text-primary me-3" style="font-size: 2rem;"></i>
                                <div>
                                    <h5 class="mb-1"><?= Html::encode($car->name) ?></h5>
                                    <p class="text-muted mb-1"><?= Html::encode($car->year_of_production) ?>, <?= Html::encode($car->color) ?></p>
                                    <p class="text-muted mb-0">Госномер: <?= Html::encode($car->registration_number) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <?= Html::a('<i class="fas fa-edit"></i>', ['/car/update', 'id' => $car->id], [
                                'class' => 'btn btn-sm btn-outline-primary me-1'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-trash"></i>', ['/car/delete', 'id' => $car->id], [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Вы уверены, что хотите удалить автомобиль?'
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>