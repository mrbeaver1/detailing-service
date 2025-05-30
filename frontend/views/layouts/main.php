<?php

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Html::tag('span', 'Premium Detailing') . Html::tag('i', '', ['class' => 'fas fa-car ms-2 text-secondary']),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-primary fixed-top',
            ],
        ]);

        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['#about'], 'linkOptions' => ['class' => 'nav-link']],
            ['label' => 'Услуги', 'url' => ['#services'], 'linkOptions' => ['class' => 'nav-link']],
            ['label' => 'Галерея', 'url' => ['#gallery'], 'linkOptions' => ['class' => 'nav-link']],
            ['label' => 'Контакты', 'url' => ['#contact'], 'linkOptions' => ['class' => 'nav-link']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => $menuItems,
        ]);

        if (Yii::$app->user->isGuest) {
            echo Html::tag('div',Html::a('Личный кабинет',Yii::$app->params['accountUrl'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
        }
        NavBar::end();
        ?>
    </header>

    <main>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </main>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h3 class="h4">О компании</h3>
                    <p class="mb-4">Premium Detailing - это профессиональный детейлинг-центр, где ваш автомобиль получает заботу и внимание, которых он заслуживает.</p>
                    <div class="social-links d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-vk"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <h3 class="h4">Наши услуги</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Полный детейлинг</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Полировка кузова</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Керамическое покрытие</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Химчистка салона</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Антидождь</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h3 class="h4">Контакты</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex">
                            <i class="fas fa-map-marker-alt text-secondary me-3 mt-1"></i>
                            <span>г. Москва, ул. Автодетейлинговая, 12</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-phone text-secondary me-3 mt-1"></i>
                            <span>+7 (495) 123-45-67</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fas fa-envelope text-secondary me-3 mt-1"></i>
                            <span>info@premiumdetailing.ru</span>
                        </li>
                        <li class="d-flex">
                            <i class="fas fa-clock text-secondary me-3 mt-1"></i>
                            <span>Пн-Пт: 9:00 - 20:00<br>Сб-Вс: 10:00 - 18:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 bg-secondary">

            <div class="text-center text-white-50">
                <p class="mb-0">&copy; <?= date('Y') ?> Premium Detailing. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>