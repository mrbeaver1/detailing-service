<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Promo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="promo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Название программы лояльности') ?>

    <?= $form->field($model, 'discount')->textInput()->label('Размер скидки') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
