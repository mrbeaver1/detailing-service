<?php

use common\models\Car;
use common\models\OrderStatus;
use common\models\Service;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput([
            'disabled' => true,
            'value' => "{$model->client->name} {$model->client->surname} {$model->client->patronymic}",
    ])->label("Клиент") ?>

    <?= $form->field($model, 'service_id')->dropDownList([
            ArrayHelper::map(Service::find()->all(), 'id', 'name'),
    ])->label('Услуга') ?>

    <?= $form->field($model, 'car_id')->dropDownList([
        ArrayHelper::map(Car::find()->where(['user_id' => $model->client_id])->all(), 'id', 'name'),
    ])->label('Автомобиль') ?>

    <?= $form->field($model, 'status')->hiddenInput([
            'value' => 1,
    ])->label(false) ?>

    <?=$form->field($model, 'date')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => 'Введите дату и время записи'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00'
        ]
    ])->label('Дата и время записи'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
