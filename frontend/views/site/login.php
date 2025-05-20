<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход в личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-center mb-4">Вход в аккаунт</h2>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'needs-validation'],
            ]); ?>
                        <div class="mb-3">

                <?= $form->field($model, 'email')->textInput([
                    'type' => 'email',
                    'autofocus' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Ваш email'
                ]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'password')->passwordInput([
                                'class' => 'form-control',
                                'placeholder' => 'Пароль'
                            ]) ?>
                        </div>

                        <div class="mb-4">
                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'class' => 'form-check-input',
                                'template' => '<div class="form-check">{input} {label}</div>'
                            ]) ?>
                        </div>

                        <div class="form-group text-center">
                            <?= Html::submitButton('Войти', [
                                'class' => 'btn btn-primary btn-lg px-4 w-100',
                                'name' => 'login-button'
                            ]) ?>
                        </div>

            <?php ActiveForm::end(); ?>
                        <div class="text-center mt-4">
                            <p>Нет аккаунта? <a href="<?= Url::to(['site/signup']) ?>" class="text-primary">Зарегистрироваться</a></p>
                            <p><a href="<?= Url::to(['site/request-password-reset']) ?>" class="text-muted">Забыли пароль?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
