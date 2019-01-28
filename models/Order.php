<?php

namespace app\models;

use Yii;

class Order extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'order';
    }


    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }


    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['email'], 'email'],
            [['name', 'email', 'phone', 'address', 'status'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'sum' => 'Сумма',
            'status' => 'Статус',
        ];
    }
}
