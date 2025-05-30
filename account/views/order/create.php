<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = 'Запись на услугу';
$this->params['breadcrumbs'][] = ['label' => 'Мои записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
