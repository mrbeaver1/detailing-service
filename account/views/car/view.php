<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Car $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить информацию об автомобиле', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить автомобиль', ['delete', 'id' => $model->id], [
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
                'attribute' => 'name',
                'label' => 'Марка',
            ],
            [
                'attribute' => 'year_of_production',
                'label' => 'Год выпуска',
            ],
            [
                'attribute' => 'color',
                'label' => 'Цвет',
            ],
            [
                'attribute' => 'registration_number',
                'label' => 'Рег. Номер',
            ],
        ],
    ]) ?>

</div>
