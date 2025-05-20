<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $service;
    public $message;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'phone', 'message'], 'required'],
            ['email', 'email'],
            ['service', 'string'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'service' => 'Услуга',
            'message' => 'Сообщение',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject('Новая заявка с сайта Premium Detailing')
            ->setTextBody($this->getEmailBody())
            ->send();
    }

    protected function getEmailBody()
    {
        return "Имя: {$this->name}\n"
            . "Телефон: {$this->phone}\n"
            . "Email: {$this->email}\n"
            . "Услуга: {$this->service}\n"
            . "Сообщение:\n{$this->message}";
    }
}