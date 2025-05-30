<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CreateClientForm extends Model
{
    public $id;
    public $surname;
    public $name;
    public $patronymic;
    public $phone;
    public $email;
    public $password;
    public $birthday;
    public $promo_id = 1;
    public $file;
    public $uploadedFile;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['promo_id', 'integer'],
            [['email', 'surname', 'name', 'patronymic', 'phone', 'file'], 'string', 'max' => 255],
            [['uploadedFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['birthday', 'safe'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function upload(): bool
    {
        if ($this->uploadedFile === null) {
            return true;
        }

        if ($this->validate()) {
            if (is_dir(Yii::getAlias('@uploads/')) === false) {
                mkdir(Yii::getAlias('@uploads/'), 0777, true);
            }
            $time = time();

            $fileName = Yii::getAlias('@uploads/') . 'user_' . $this->uploadedFile->baseName . '_' . $time . '.' . $this->uploadedFile->extension;

            $this->uploadedFile->saveAs($fileName);

            $this->file = $fileName;

            return true;
        } else {
            return false;
        }
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function create()
    {
        $user = new User();
        $user->surname = $this->surname;
        $user->name = $this->name;
        $user->patronymic = $this->patronymic;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->birthday = $this->birthday;
        $user->promo_id = $this->promo_id;
        $user->role = 'client';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;
        $user->avatar = $this->file;
        $user->created_at = date('Y-m-d H:i:s');

        $user->save(false);

        $this->id = $user->id;

        return true;
    }
}
