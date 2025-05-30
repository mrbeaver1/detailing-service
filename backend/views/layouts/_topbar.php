<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
?>

<nav class="topbar">
    <button class="btn btn-link d-lg-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>


    <div class="ms-auto topbar-user">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                <?php
                $options = [
                    'http' => [
                        'header' => "User-Agent: MyApp/1.0 (https://example.com; contact@example.com)\r\n"
                    ]
                ];
                $context = stream_context_create($options);
                $src = Yii::$app->user->identity?->avatar === null ? '' : 'data:image/png;base64, ' . base64_encode(file_get_contents(Yii::$app->user->identity?->avatar, false, $context) ?? '' )
                ?>
                <?= Html::img($src, [
                    'alt' => 'User',
                    'class' => 'rounded-circle me-2',
                    'width' => '36'
                ]) ?>
                <span><?= Yii::$app->user->identity?->email ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
<!--                <li>--><?php //= Html::a('<i class="fas fa-user me-2"></i> Профиль', ['/user/profile'], ['class' => 'dropdown-item']) ?><!--</li>-->
<!--                <li>--><?php //= Html::a('<i class="fas fa-cog me-2"></i> Настройки', ['/user/settings'], ['class' => 'dropdown-item']) ?><!--</li>-->
<!--                <li><hr class="dropdown-divider"></li>-->
                <li>
                    <?= Html::a('<i class="fas fa-sign-out-alt me-2"></i> Выход', ['/site/logout'], [
                        'class' => 'dropdown-item',
                        'data-method' => 'post'
                    ]) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>