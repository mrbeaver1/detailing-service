<?php

use common\models\Review;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var account\models\search\ReviewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'text:ntext',
            'rating',
            'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Review $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
