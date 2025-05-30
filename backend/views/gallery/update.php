<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Gallery $model */

$this->title = 'Обновить запись № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Галерея работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить запись в галерее работ';
?>
<div class="gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
