<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Promo $model */

$this->title = 'Изменение программы ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Программы лояльности', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение программы';
?>
<div class="promo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
