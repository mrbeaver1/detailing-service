<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Car $model */

$this->title = 'Добавить автомобиль';
$this->params['breadcrumbs'][] = ['label' => 'Мои автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
