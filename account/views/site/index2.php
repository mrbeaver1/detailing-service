<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="account-header">
    <h1><i class="fas fa-tachometer-alt me-2"></i> Обзор</h1>
    <?= Html::a('<i class="fas fa-plus me-1"></i> Новая запись', ['/booking/create'], [
        'class' => 'btn btn-primary btn-account'
    ]) ?>
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
        <?= Html::a('Все записи', ['/account/bookings'], ['class' => 'text-white']) ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Услуга</th>
                    <th>Автомобиль</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($activeBookings as $booking): ?>
                    <tr>
                        <td><?= Yii::$app->formatter->asDatetime($booking->date) ?></td>
                        <td><?= Html::encode($booking->service->name) ?></td>
                        <td><?= Html::encode($booking->car->model) ?></td>
                        <td>
                            <span class="status-badge <?= $booking->getStatusClass() ?>">
                                <?= $booking->getStatusName() ?>
                            </span>
                        </td>
                        <td>
                            <?= Html::a('<i class="fas fa-edit"></i>', ['/booking/update', 'id' => $booking->id], [
                                'class' => 'btn btn-sm btn-outline-primary me-1'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-times"></i>', ['/booking/cancel', 'id' => $booking->id], [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'data-method' => 'post',
                                'data-confirm' => 'Вы уверены, что хотите отменить запись?'
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
                                    <h5 class="mb-1"><?= Html::encode($car->model) ?></h5>
                                    <p class="text-muted mb-1"><?= Html::encode($car->year) ?>, <?= Html::encode($car->color) ?></p>
                                    <p class="text-muted mb-0">Госномер: <?= Html::encode($car->license_plate) ?></p>
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