<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Gallery $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить запись', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
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
                'attribute' => 'id',
                'label' => 'Номер работы',
            ],
            [
                'attribute' => 'path',
                'label' => 'Фото',
                'format' => ['image', ['width' => '70']],
                'value' => function ($model) {
                    $path = $model->path;
                    $options = [
                        'http' => [
                            'header' => "User-Agent: MyApp/1.0 (https://example.com; contact@example.com)\r\n"
                        ]
                    ];
                    $context = stream_context_create($options);
                    $base64 = $path === null ? '' : base64_encode(file_get_contents($model->path, false, $context));

                    return 'data:image/png;base64,' . $base64;
                }
            ],
            [
                'attribute' => 'alt',
                'label' => 'Описание',
            ],
        ],
    ]) ?>

</div>
