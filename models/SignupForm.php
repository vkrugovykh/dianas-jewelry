<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 30.01.2019
 * Time: 14:06
 */

namespace app\models;


use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required', 'message' => 'Заполните поле'],
            [['email'], 'email'],
            ['username', 'unique', 'targetClass' => User::class,  'message' => 'Этот логин уже занят'],
            ['email', 'unique', 'targetClass' => User::class,  'message' => 'Этот e-mail уже занят'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'e-mail',
            'password' => 'Пароль',
        ];
    }
}