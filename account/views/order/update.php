<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = 'Изменение записи №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение записи';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
