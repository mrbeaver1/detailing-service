<?php
namespace account\controllers;

use common\models\Car;
use common\models\Order;
use common\models\Review;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        $user = Yii::$app->user->identity;
        $activeBookings = Order::find()
            ->where(['client_id' => $user->id])
            ->orderBy(['date' => SORT_ASC])
            ->limit(5)
            ->all();

        $cars = Car::find()->where(['user_id' => $user->id])->all();

        $reviews = Review::find()->select('rating')->where(['user_id' => $user->id])->column();

        $count = count($reviews);

        $averageRating = $count === 0 ? 0 : array_sum($reviews) / $count;

        $discount = $user->promo;

        return $this->render('index', [
            'user' => $user,
            'activeBookings' => $activeBookings,
            'cars' => $cars,
            'activeBookingsCount' => count($activeBookings),
            'carsCount' => count($cars),
            'averageRating' => $averageRating,
            'discount' => $discount->discount ?? 0,
        ]);
    }

    public function actionBookings()
    {
        // Логика для раздела "Мои записи"
    }

    public function actionCars()
    {
        // Логика для раздела "Мои автомобили"
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

    // Другие действия...
}