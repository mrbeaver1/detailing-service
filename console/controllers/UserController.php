<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\User;
use Yii;

class UserController extends Controller
{
    public function actionCreateAdmin($email, $password)
    {
        $user = new User();
        $user->email = $email;
        $user->surname = 'admin';
        $user->name = 'admin';
        $user->email = $email;
        $user->role = 'admin';
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;

        if ($user->save()) {
            echo "User created successfully!\n";
            return 0;
        } else {
            echo "Error creating user:\n";
            print_r($user->errors);
            return 1;
        }
    }
}