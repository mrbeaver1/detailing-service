<?php

use common\models\Review;
use yii\helpers\Url;
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="<?= Url::to(['/site/index']) ?>" class="sidebar-brand">
            <i class="fas fa-car"></i>
            <span class="sidebar-brand-text">Premium Detailing</span>
        </a>
        <button class="sidebar-toggle" id="sidebarCollapse">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="<?= Url::to(['/site/index']) ?>" class="<?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Дашборд</span>
            </a>
        </li>

        <li class="sidebar-divider"></li>

        <li>
            <a href="<?= Url::to(['/order/index']) ?>" class="<?= Yii::$app->controller->id == 'order' ? 'active' : '' ?>">
                <i class="fas fa-calendar-check"></i>
                <span>Записи</span>
<!--                <span class="badge bg-danger ms-auto"><\backend\models\Order::getNewCount()</span>-->
                <span class="badge bg-danger ms-auto"><?= 7 ?></span>
            </a>
        </li>

        <li>
            <a href="<?= Url::to(['/client/index']) ?>" class="<?= Yii::$app->controller->id == 'client' ? 'active' : '' ?>">
                <i class="fas fa-users"></i>
                <span>Клиенты</span>
            </a>
        </li>

        <li>
            <a href="<?= Url::to(['/service/index']) ?>" class="<?= Yii::$app->controller->id == 'service' ? 'active' : '' ?>">
                <i class="fas fa-spray-can"></i>
                <span>Услуги</span>
            </a>
        </li>

        <li>
            <a href="<?= Url::to(['/gallery/index']) ?>" class="<?= Yii::$app->controller->id == 'gallery' ? 'active' : '' ?>">
                <i class="fas fa-images"></i>
                <span>Галерея</span>
            </a>
        </li>

        <li class="sidebar-divider"></li>

        <li>
            <a href="<?= Url::to(['/review/index']) ?>" class="<?= Yii::$app->controller->id == 'review' ? 'active' : '' ?>">
                <i class="fas fa-comment-alt"></i>
                <span>Отзывы</span>
                <span class="badge bg-warning ms-auto"><?= Review::find()->count() ?> </span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['/promo/index']) ?>" class="<?= Yii::$app->controller->id == 'promo' ? 'active' : '' ?>">
                <i class="fa-solid fa-percent"></i>
                <span>Программы лояльности</span>
            </a>
        </li>
    </ul>
</div>