<?php

use common\models\Promo;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'surname')->textInput()->label('Фамилия') ?>
    <?= $form->field($model, 'name')->textInput()->label('Имя') ?>
    <?= $form->field($model, 'patronymic')->textInput()->label('Отчество') ?>
    <?= $form->field($model, 'phone')->textInput()->label('Номер телефона') ?>
    <?= $form->field($model, 'email')->textInput(['type' => 'email'])->label('Эл. почта') ?>
    <?= $form->field($model, 'promo_id')->dropDownList(
        ArrayHelper::map(Promo::find()->all(), 'id', 'title'),
    )->label('Дисконтная программа') ?>
    <?= $form->field($model, 'uploadedFile')->fileInput()->label('Аватар') ?>
    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
    <?=$form->field($model, 'birthday')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => 'Введите дату рождения'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00'
        ]
    ])->label('Дата рождения'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
