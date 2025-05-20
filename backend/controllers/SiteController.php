<?php

namespace backend\controllers;

use common\models\Order;
use common\models\User;
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
//        return $this->render('index', [
//            'ordersCount' => \common\models\Order::getTodayCount(),
//            'newClients' => \common\models\Client::getNewCount(),
//            'revenue' => \common\models\Order::getMonthRevenue(),
//            'reviews' => \common\models\Review::getNewCount(),
//        ]);

        return $this->render('index', [
            'ordersCount' => 50,
            'newClients' => 100,
            'revenue' => 7000,
            'reviews' => 5,
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