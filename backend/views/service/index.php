<?php

use common\models\Service;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ServiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <?= Html::a('Добавить услугу', ['create'], ['class' => 'btn btn-sm btn-outline-success']) ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
//                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',
                        'price',
                        'created_at',
                        'updated_at',
                        //'deleted_at',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Service $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                             }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
</div>
</div>