<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$form = ActiveForm::begin([
    'id' => 'contact-form',
    'enableAjaxValidation' => true,
    'options' => ['class' => 'needs-validation'],
]); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'name')->textInput([
                'autofocus' => true,
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'phone')->textInput([
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>
    </div>

<?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>

<?= $form->field($model, 'service')->dropDownList([
    '' => 'Выберите услугу',
    'full' => 'Полный детейлинг',
    'polish' => 'Полировка кузова',
    'ceramic' => 'Керамическое покрытие',
    'cleaning' => 'Химчистка салона',
    'antirain' => 'Антидождь',
    'care' => 'Детейлинговый уход'
], ['class' => 'form-select']) ?>

<?= $form->field($model, 'message')->textarea([
    'rows' => 4,
    'class' => 'form-control'
]) ?>

<?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    'options' => ['class' => 'form-control']
]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Отправить заявку', [
            'class' => 'btn btn-primary btn-lg px-4',
            'name' => 'contact-button'
        ]) ?>
    </div>

<?php ActiveForm::end(); ?>