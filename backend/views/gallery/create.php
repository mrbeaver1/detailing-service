<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Gallery $model */

$this->title = 'Добавить в галерею';
$this->params['breadcrumbs'][] = ['label' => 'Галерея работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
