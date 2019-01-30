<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 29.01.2019
 * Time: 23:08
 */

namespace app\models;


use yii\db\ActiveRecord;

class Subscribe extends ActiveRecord
{
    //Название таблицы
    public static function tableName()
    {
        return 'subscription';
    }

    public function subscribeValid($key)
    {
        $id = Subscribe::find()->where(['activation_key' => $key])->one()['id'];
        if ($id) {
            $subscribe = Subscribe::find()->where(['id' => $id])->one();
            $subscribe->subscribe = 1;
            if ($subscribe->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function checkEmail($email)
    {
        return Subscribe::find()->where(['email' => $email])->one();
    }

}