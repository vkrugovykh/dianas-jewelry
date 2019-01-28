<?php

namespace app\models;

use Yii;


class OrderProduct extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'order_product';
    }


    public function getOrder()
    {
        return $this->hasOne(OrderProduct::class, ['id' => 'order_id']);
    }


    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'price', 'quantity', 'sum'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

}