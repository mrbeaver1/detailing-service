<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-sm btn-outline-success']) ?>
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
                'attribute' => 'avatar',
                'label' => 'Фото',
                'format' => ['image', ['width' => '70']],
                'value' => function ($model) {
                    $path = $model->avatar;
                    $options = [
                        'http' => [
                            'header' => "User-Agent: MyApp/1.0 (https://example.com; contact@example.com)\r\n"
                        ]
                    ];
                    $context = stream_context_create($options);
                    $base64 = $path === null ? '' : base64_encode(file_get_contents($model->avatar, false, $context));

                    return 'data:image/png;base64,' . $base64;
                }
            ],
            [
                'attribute' => 'surname',
                'label' => 'Фамилия'
            ],
            [
                'attribute' => 'name',
                'label' => 'Имя'
            ],
            [
                'attribute' => 'patronymic',
                'label' => 'Отчество'
            ],
            [
                'attribute' => 'phone',
                'label' => 'Номер телефона',
            ],
            [
                'attribute' => 'email',
                'label' => 'Эл. почта',
                'format' => 'email',
            ],
            [
                'attribute' => 'birthday',
                'label' => 'Дата рождения',
                'format' => ['date', 'php:d.m.Y'],
            ],
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
//            'role',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
            </div>
        </div>
    </div>

</div>
