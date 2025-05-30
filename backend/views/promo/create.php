<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Promo $model */

$this->title = 'Добавить программу лояльности';
$this->params['breadcrumbs'][] = ['label' => 'Программы лояльности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
