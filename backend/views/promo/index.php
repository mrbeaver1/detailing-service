<?php

use common\models\Promo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\PromoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Программы лояльности';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-index">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <?= Html::a('Добавить программу лояльности', ['create'], ['class' => 'btn btn-sm btn-outline-success']) ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Promo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


        </div>
    </div>
</div>
