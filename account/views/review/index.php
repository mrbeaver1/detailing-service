<?php

use common\models\Review;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var account\models\search\ReviewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">
    <div class="card-header account-card-header d-flex justify-content-between align-items-center">
        <span><?= Html::encode($this->title) ?></span>

        <?= Html::a('Добавить отзыв', ['create'], ['class' => 'btn btn-sm btn-light']) ?>
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
                'attribute' => 'id',
                'label' => 'Номер отзыва',
            ],
            [
                'attribute' => 'text',
                'label' => 'Текст отзыва',
                'format' => 'ntext',
            ],
            [
                'attribute' => 'rating',
                'label' => 'Количество звезд',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Review $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

        </div>
    </div>
</div>
