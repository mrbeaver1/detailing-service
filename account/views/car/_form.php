<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Марка автомобиля') ?>

    <?= $form->field($model, 'year_of_production')->textInput()->label('Год выпуска') ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true])->label('Цвет') ?>

    <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true])->label('Рег. Номер') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
