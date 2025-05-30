<?php

use common\models\Car;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои автомобили';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">
    <div class="card-header account-card-header d-flex justify-content-between align-items-center">
        <span><?= Html::encode($this->title) ?></span>

        <?= Html::a('Добавить автомобиль', ['create'], ['class' => 'btn btn-sm btn-light']) ?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card-body">
        <div class="table-responsive">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}\n{summary}",
        'columns' => [
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
            //'registration_number',
            //'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Car $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

        </div>
    </div>


</div>

