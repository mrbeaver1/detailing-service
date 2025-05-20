<?php

use common\models\OrderStatus;
use common\models\Service;
use common\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin();

    $users = User::find()->all();

    foreach ($users as &$user) {
        $user = ['id' => $user->id, 'name' => "$user->surname $user->name $user->patronymic"];
    }
    ?>

    <?= $form->field($model, 'client_id')->dropDownList([
        ArrayHelper::map($users, 'id', 'name'),
    ]) ?>

    <?= $form->field($model, 'service_id')->dropDownList([
        ArrayHelper::map(Service::find()->all(), 'id', 'name'),
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
