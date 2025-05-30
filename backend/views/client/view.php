<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменит информацию о клиенте', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить клиента', ['delete', 'id' => $model->id], [
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
        ],
    ]) ?>

</div>
