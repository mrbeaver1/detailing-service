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
    ]) ?>

    <?= $form->field($model, 'service_id')->dropDownList([
            ArrayHelper::map(Service::find()->all(), 'id', 'name'),
    ]) ?>

    <?= $form->field($model, 'car_id')->dropDownList([
        ArrayHelper::map(Car::find()->where(['user_id' => $model->client_id])->all(), 'id', 'name'),
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
            ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
    ]) ?>

    <?=$form->field($model, 'date')->widget(DateTimePicker::class, [
        'options' => ['placeholder' => 'Введите дату и время записи'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00'
        ]
    ]); ?>

<!--    --><?php //= $form->field($model, 'date')->textInput() ?>

<!--    --><?php //= $form->field($model, 'personal_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
