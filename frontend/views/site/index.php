<?php

use common\models\Review;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Premium Detailing - Профессиональный детейлинг автомобилей';
?>

<!-- Hero Section -->
<section class="hero d-flex align-items-center" id="home">
    <div class="container text-center text-white">
        <h1 class="display-3 fw-bold mb-4">Профессиональный детейлинг автомобилей</h1>
        <p class="lead mb-5">Вернем вашему автомобилю первозданный вид и защитим на долгие годы с помощью наших премиальных услуг</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#services" class="btn btn-primary btn-lg px-4">Наши услуги</a>
            <a href="#contact" class="btn btn-accent btn-lg px-4">Записаться</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5" id="about">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title">О нашей компании</h2>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-4">Premium Detailing - лидер в индустрии детейлинга</h3>
                <p class="mb-3">Мы - команда профессионалов с многолетним опытом в области детейлинга автомобилей. Наша миссия - предоставлять услуги высочайшего качества, используя только профессиональные материалы и оборудование.</p>
                <p class="mb-3">Каждый автомобиль для нас - это произведение искусства, которое заслуживает индивидуального подхода и безупречного исполнения.</p>
                <p class="mb-4">Мы постоянно совершенствуем свои навыки и следим за последними тенденциями в индустрии, чтобы предлагать вам только лучшие решения.</p>
                <a href="#services" class="btn btn-primary">Узнать больше</a>
            </div>
            <div class="col-lg-6">
                <!-- @web/images/detailing-about.jpg -->
                <?= Html::img('https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80', [
                    'alt' => 'Детейлинг автомобиля',
                    'class' => 'img-fluid rounded shadow-lg'
                ]) ?>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light" id="services">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title">Наши услуги</h2>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $service): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm p-4 service-card">
                    <div class="service-icon text-center">
                        <i class="<?= $service['icon'] ?>"></i>
                    </div>
                    <div class="card-body text-center">
                        <h3 class="card-title fw-bold"><?= $service['name'] ?></h3>
                        <p class="card-text"><?= $service['description'] ?></p>
                        <div class="price"><?= $service['price'] ?> ₽</div>
                        <a href="#contact" class="btn btn-primary mt-2">Заказать</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Остальные услуги аналогично -->
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5" id="gallery">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title">Наши работы</h2>
        </div>

        <div class="row g-4">
            <?php foreach ($galleryItems as $item): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="gallery-item">
                        <?php
                        $options = [
                            'http' => [
                                'header' => "User-Agent: MyApp/1.0 (https://example.com; contact@example.com)\r\n"
                            ]
                        ];
                        $context = stream_context_create($options);
                        $src = $item['path'] === null ? '' : 'data:image/png;base64, ' . base64_encode(file_get_contents($item['path'], false, $context) ?? '' )
                        ?>
                        <?= Html::img($src, ['class' => 'img-fluid', 'alt' => $item['alt']]) ?>
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus text-white fs-3"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title">Отзывы клиентов</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="testimonial-slider">
                    <?php foreach (Review::find()->all() as $review): ?>
                    <?php
                    $options = [
                        'http' => [
                            'header' => "User-Agent: MyApp/1.0 (https://example.com; contact@example.com)\r\n"
                        ]
                    ];
                    $context = stream_context_create($options);
                    $src = $review->user?->avatar === null ? '' : 'data:image/png;base64, ' . base64_encode(file_get_contents($review->user?->avatar, false, $context) ?? '' )
                    ?>
                    <div class="testimonial text-center p-4 bg-white rounded shadow-sm active">

                        <?= Html::img($src, [
                            'alt' => 'Клиент',
                            'class' => 'rounded-circle mb-3',
                            'width' => '80',
                            'height' => '80',
                        ]) ?>
                        <p class="mb-3"><?=$review->text?></p>
                        <div class="client-rating mb-3">
                        <?php
                        $farIconsCount = 5 - $review->rating;
                        for ($i = 1; $i <= $review->rating; $i++) {
                            echo '<i class="fa fa-star"></i>';
                        }

                        if ($farIconsCount !== 0) {
                            for ($i = 1; $i <= $farIconsCount; $i++) {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                        ?>
                        </div>
                        <h5 class="fw-bold"><?=$review->user?->surname . ' ' . $review->user?->name . ' ' . $review->user?->patronymic ?></h5>
                    </div>
                    <?php endforeach; ?>

                <div class="d-flex justify-content-center mt-4">
                    <?php for ($i = 0; $i < Review::find()->count(); $i++): ?>
                    <button class="btn btn-sm btn-secondary rounded-circle mx-1 slider-dot" data-slide=<?=$i ?>></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section-->
<section class="py-5" id="contact">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold section-title">Свяжитесь с нами</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <?= $form->field($contactForm, 'name')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $form->field($contactForm, 'phone') ?>
                            </div>
                        </div>

                        <?= $form->field($contactForm, 'email') ?>

                        <?= $form->field($contactForm, 'service')->dropDownList([
                            '' => 'Выберите услугу',
                            'full' => 'Полный детейлинг',
                            'polish' => 'Полировка кузова',
                            'ceramic' => 'Керамическое покрытие',
                            'cleaning' => 'Химчистка салона',
                            'antirain' => 'Антидождь',
                            'care' => 'Детейлинговый уход'
                        ]) ?>

                        <?= $form->field($contactForm, 'message')->textarea(['rows' => 6]) ?>

                        <?= $form->field($contactForm, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary btn-lg px-4', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>