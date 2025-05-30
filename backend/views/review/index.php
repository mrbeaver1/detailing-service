<?php

use common\models\Review;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\ReviewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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
                'attribute' => 'user_id',
                'label' => 'Автор отзыва',
                'value' => function ($model) {
                    return $model->user?->surname.' '.$model->user?->name.' '.$model->user?->patronymic;
                }
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
                'class' => ActionColumn::class,
                'template' => '{view} ',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'title' => 'Посмотреть'
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
            </div>
        </div>
    </div>
