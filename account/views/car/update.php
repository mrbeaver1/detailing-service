<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Car $model */

$this->title = 'Обновить информацию об автомобиле: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление информации об автомобиле';
?>
<div class="car-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
