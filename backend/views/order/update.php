<?php

use common\models\Car;
use common\models\OrderStatus;
use common\models\Service;
use common\models\User;
use kartik\datetime\DateTimePicker;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = 'Изменение записи №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение записи';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin();

    $users = User::find()->all();

    foreach ($users as &$user) {
        $user = ['id' => $user->id, 'name' => "$user->surname $user->name $user->patronymic"];
    }
    ?>

    <?= $form->field($model, 'client_id')->dropDownList(
        ArrayHelper::map($users, 'id', 'name')
    )->label("Клиент")
    ?>

    <?= $form->field($model, 'service_id')->dropDownList(
        ArrayHelper::map(Service::find()->all(), 'id', 'name'),
    )->label('Услуга') ?>

    <?= $form->field($model, 'car_id')->dropDownList(
        ArrayHelper::map(Car::find()->where(['user_id' => $model->client_id])->all(), 'id', 'name'),
    )->label('Автомобиль') ?>

    <?= $form->field($model, 'status')->dropDownList(
        ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
    )->label('Статус') ?>

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
