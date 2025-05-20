<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-center mb-4">Регистрация</h2>
                        <?php $form = ActiveForm::begin([
                            'id' => 'register-form',
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>
                        <div class="mb-3">
                            <?= $form->field($model, 'email')->textInput([
                                'type' => 'email',
                                'class' => 'form-control',
                                'placeholder' => 'Ваш email',
                                'autofocus' => true
                            ]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'password')->passwordInput([
                                'class' => 'form-control',
                                'placeholder' => 'Пароль'
                            ]) ?>
                        </div>

                        <div class="form-group text-center">
                            <?= Html::submitButton('Зарегистрироваться', [
                                'class' => 'btn btn-primary btn-lg px-4 w-100',
                                'name' => 'register-button'
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <div class="text-center mt-4">
                            <p>Уже есть аккаунт? <a href="<?= Url::to(['site/login']) ?>" class="text-primary">Войти</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
