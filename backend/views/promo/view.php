<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Promo $model */

$this->title = 'Программа лояльности ' .$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Программы лояльности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="promo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить программу', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить программу', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'Номер программы'
            ],
            [
                'attribute' => 'title',
                'label' => 'Название программы лояльности'
            ],
            [
                'attribute' => 'discount',
                'label' => 'Размер скидки'
            ],
        ],
    ]) ?>

</div>
