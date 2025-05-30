<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class UpdateClientForm extends Model
{
    public $id;
    public $surname;
    public $name;
    public $patronymic;
    public $phone;
    public $email;
    public $password;
    public $birthday;
    public $promo_id;
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
            ['birthday', 'safe'],
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

            if ($this->file && $this->file !== $fileName && str_contains($this->file, "http") === false) {
                unlink($this->file);
            }

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
    public function update()
    {
        $user = User::findOne($this->id);
        
        $user->surname = $this->surname;
        $user->name = $this->name;
        $user->patronymic = $this->patronymic;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->birthday = $this->birthday;
        $user->promo_id = $this->promo_id;
        if ($this->password !== null) {
            $user->setPassword($this->password);
        }
        $user->avatar = $this->file;
        $user->updated_at = date('Y-m-d H:i:s');

        return $user->save(false);
    }
}
