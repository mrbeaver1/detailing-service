<?php

use common\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-sm btn-outline-success']) ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'client_id',
                            'label' => 'Клиент',
                            'value' => function($model) {
                                return "{$model->client->surname} {$model->client->name}";
                            }
                        ],
                        [
                            'attribute' => 'service_id',
                            'label' => 'Услуга',
                            'value' => function($model) {
                                return $model->service->name;
                            }
                        ],
                        [
                            'attribute' => 'date',
                            'label' => 'Дата и время',
                            'format' => ['date', 'php:d.m.Y H:i:s'],
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Статус',
                            'content' => function($model) {
                                $statuses = [
                                    'pending' => ['text' => 'Ожидание', 'class' => 'status-pending'],
                                    'confirmed' => ['text' => 'Подтверждено', 'class' => 'status-active'],
                                    'canceled' => ['text' => 'Отменено', 'class' => 'status-canceled'],
                                ];
                                $status = $statuses[$model->status] ?? $statuses['pending'];
                                return Html::tag('span', $status['text'], ['class' => 'status-badge ' . $status['class']]);
                            }
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                             }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>

</div>
