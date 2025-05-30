<?php

namespace backend\controllers;

use common\models\Order;
use common\models\Review;
use common\models\User;
use DateTimeImmutable;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $reviewCount = Review::find()->count();
        $reviewSum = Review::find()->sum('rating');

        $reviewAvg = $reviewCount == 0 ? 0 : $reviewSum / $reviewCount;

        return $this->render('index', [
            'ordersCount' => Order::find()->where(['status' => 1])->count(),
            'ordersCountForWeek' => Order::find()->where(['status' => 1])->andWhere(['between', 'created_at', (new DateTimeImmutable('first day of this week'))->format('Y-m-d 00:00:00'), (new DateTimeImmutable())->format('Y-m-d H:i:s')])->count(),
            'newClients' => User::find()->where(['between', 'created_at', (new DateTimeImmutable('first day of this month'))->format('Y-m-d 00:00:00'), (new DateTimeImmutable())->format('Y-m-d H:i:s')])->andWhere(['role' => 'client'])->count(),
            'revenue' => Order::find()->where(['status' => 4])->sum('personal_price'),
            'revenueForMonth' => Order::find()->where(['status' => 4])->andWhere(['between', 'updated_at', (new DateTimeImmutable('first day of this month'))->format('Y-m-d 00:00:00'), (new DateTimeImmutable())->format('Y-m-d H:i:s')])->sum('personal_price'),
            'reviews' => $reviewCount,
            'reviewsAvg' => round($reviewAvg, 1),
            'recentOrders' => Order::find()->orderBy(['id' => SORT_DESC])->limit(5)->all(),
            'recentClients' => User::find()->where(['role' => 'client'])->orderBy(['id' => SORT_DESC])->limit(5)->all(),
        ]);
    }

    public function actionSearch($q)
    {
        // Реализация поиска
        $results = [];

        return $this->render('search', [
            'query' => $q,
            'results' => $results,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \common\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}