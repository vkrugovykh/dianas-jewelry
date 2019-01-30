<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }

//        return null;
    }


    public function getId()
    {
        return $this->id;
    }


    public function isAdmin()
    {
        if (Yii::$app->user->identity->is_admin === 1) {
            return true;
        } else {
            return false;
        }
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }


    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomeString();
    }


    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
