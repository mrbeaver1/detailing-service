<?php

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

// Получаем состояние сайдбара из localStorage через JavaScript
$this->registerJs('
    document.addEventListener("DOMContentLoaded", function() {
        const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
        if (isCollapsed) {
            document.getElementById("sidebar").classList.add("sidebar-collapsed");
            document.querySelector(".main-content").classList.add("sidebar-collapsed");
        }
    });
');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Админ-панель</title>
        <?php $this->head() ?>
    </head>
    <body class="admin-panel">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Sidebar -->
        <?= $this->render('_sidebar') ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <?= $this->render('_topbar') ?>

            <!-- Page Content -->
            <div class="container-fluid p-4">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb mb-4'],
                ]) ?>

                <?= $content ?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>