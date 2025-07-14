<?php

use account\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="account-sidebar" id="accountSidebar">
        <div class="account-sidebar-header">
            <img src="<?= Yii::$app->user->identity?->avatar ?>" alt="User" class="user-avatar">
            <h5 class="mb-1"><?= Yii::$app->user->identity?->name ?></h5>
            <p class="text-muted mb-0">Клиент с <?= Yii::$app->user->identity?->created_at?></p>
        </div>

        <ul class="account-sidebar-menu">
            <li>
                <a href="<?= Url::to(['site/index']) ?>" class="<?= $this->context->id === 'site' ? 'active' : '' ?>" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Обзор</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to(['/order/index']) ?>" class="<?= $this->context->id === 'order' ? 'active' : '' ?>" data-section="bookings">
                    <i class="fas fa-calendar-check"></i>
                    <span>Мои записи</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to(['/car/index']) ?>" class="<?= $this->context->id === 'car' ? 'active' : '' ?>" data-section="cars">
                    <i class="fas fa-car"></i>
                    <span>Мои автомобили</span>
                </a>
            </li>

<!--            <li>-->
<!--                <a href="--><?php //= Url::to(['account/history']) ?><!--" class="--><?php //= $this->context->action->id === 'history' ? 'active' : '' ?><!--" data-section="history">-->
<!--                    <i class="fas fa-history"></i>-->
<!--                    <span>История услуг</span>-->
<!--                </a>-->
<!--            </li>-->

            <li>
                <a href="<?= Url::to(['review/index']) ?>" class="<?= $this->context->id === 'review' ? 'active' : '' ?>" data-section="reviews">
                    <i class="fas fa-star"></i>
                    <span>Мои отзывы</span>
                </a>
            </li>

<!--            <li>-->
<!--                <a href="--><?php //= Url::to(['account/promo']) ?><!--" class="--><?php //= $this->context->action->id === 'promo' ? 'active' : '' ?><!--" data-section="promo">-->
<!--                    <i class="fas fa-percentage"></i>-->
<!--                    <span>Акции и скидки</span>-->
<!--                </a>-->
<!--            </li>-->
            <li>
                <a href="<?= Url::to(['site/logout']) ?>" data-method="post">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Выход</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="account-content" id="accountContent">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb mb-4'],
        ]) ?>
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>