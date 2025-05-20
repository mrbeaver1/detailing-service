<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Дашборд';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Записи сегодня</h6>
                        <h3 class="mb-0"><?= $ordersCount ?></h3>
                    </div>
                    <div class="card-icon text-primary">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Новые клиенты</h6>
                        <h3 class="mb-0">5</h3>
                    </div>
                    <div class="card-icon text-success">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Выручка</h6>
                        <h3 class="mb-0">85,400 ₽</h3>
                    </div>
                    <div class="card-icon text-info">
                        <i class="fas fa-ruble-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Отзывы</h6>
                        <h3 class="mb-0">24</h3>
                    </div>
                    <div class="card-icon text-warning">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Остальные карточки статистики -->
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Последние записи</h5>
                <?= Html::a('Все записи', ['/order/index'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $recentOrders,
                            'pagination' => false,
                        ]),
                        'layout' => '{items}',
                        'columns' => [
                            'id',
                            [
                                'attribute' => 'client_id',
                                'label' => 'Клиент',
                                'value' => function($model) {
                                    return "{$model->client->surname} {$model->client->name}";
                                }
                            ],
                            [
                                'attribute' => 'service_id',
                                'label' => 'Услуга',
                                'value' => function($model) {
                                    return $model->service->name;
                                }
                            ],
                            [
                                'attribute' => 'date',
                                'label' => 'Дата и время',
                                'format' => ['date', 'php:d.m.Y H:i:s'],
                            ],
                            [
                                'attribute' => 'status',
                                'label' => 'Статус',
                                'content' => function($model) {
                                    $statuses = [
                                        'pending' => ['text' => 'Ожидание', 'class' => 'status-pending'],
                                        'confirmed' => ['text' => 'Подтверждено', 'class' => 'status-active'],
                                        'canceled' => ['text' => 'Отменено', 'class' => 'status-canceled'],
                                    ];
                                    $status = $statuses[$model->status] ?? $statuses['pending'];
                                    return Html::tag('span', $status['text'], ['class' => 'status-badge ' . $status['class']]);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<i class="fas fa-eye"></i>', ['/order/view', 'id' => $model->id], [
                                            'class' => 'btn btn-sm btn-outline-secondary',
                                            'title' => 'Просмотр'
                                        ]);
                                    },
                                    'update' => function($url, $model) {
                                        return Html::a('<i class="fas fa-edit"></i>', ['/order/update', 'id' => $model->id], [
                                            'class' => 'btn btn-sm btn-outline-primary',
                                            'title' => 'Редактировать'
                                        ]);
                                    }
                                ]
                            ]
                        ],
                        'tableOptions' => ['class' => 'table table-hover']
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Последние клиенты</h5>
                <?= Html::a('Все записи', ['/client/index'], ['class' => 'btn btn-sm btn-outline-primary']) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => new \yii\data\ArrayDataProvider([
                            'allModels' => $recentClients,
                            'pagination' => false,
                        ]),
                        'layout' => '{items}',
                        'columns' => [
                            [
                                'attribute' => 'surname',
                                'label' => 'Фамилия'
                            ],
                            [
                                'attribute' => 'name',
                                'label' => 'Имя'
                            ],
                            [
                                'attribute' => 'patronymic',
                                'label' => 'Отчество'
                            ],
                            [
                                'attribute' => 'phone',
                                'label' => 'Номер телефона',
                            ],
                            [
                                'attribute' => 'email',
                                'label' => 'Эл. почта',
                                'format' => 'email',
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<i class="fas fa-eye"></i>', ['/client/view', 'id' => $model->id], [
                                            'class' => 'btn btn-sm btn-outline-secondary',
                                            'title' => 'Просмотр'
                                        ]);
                                    },
                                ]
                            ]
                        ],
                        'tableOptions' => ['class' => 'table table-hover']
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Быстрые действия</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= Html::a('<i class="fas fa-plus-circle me-2"></i> Новая запись', ['/order/create'], [
                            'class' => 'btn btn-outline-primary w-100 py-3'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::a('<i class="fas fa-user-plus me-2"></i> Добавить клиента', ['/client/create'], [
                                'class' => 'btn btn-outline-success w-100 py-3'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::a('<i class="fas fa-spray-can me-2"></i> Добавить услугу', ['/service/create'], [
                            'class' => 'btn btn-outline-info w-100 py-3'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::a('<i class="fas fa-image me-2"></i> Добавить в галерею', ['/gallery/create'], [
                            'class' => 'btn btn-outline-warning w-100 py-3'
                        ]) ?>
                    </div>
                    <!-- Остальные кнопки -->
                </div>
                <hr>

                <h6 class="mb-3">Статистика</h6>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded text-center">
                            <h4 class="mb-0">24</h4>
                            <small class="text-muted">Записей за неделю</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 border rounded text-center">
                            <h4 class="mb-0">8</h4>
                            <small class="text-muted">Новых клиентов</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border rounded text-center">
                            <h4 class="mb-0">142,500 ₽</h4>
                            <small class="text-muted">Выручка за месяц</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border rounded text-center">
                            <h4 class="mb-0">4.8</h4>
                            <small class="text-muted">Средняя оценка</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>