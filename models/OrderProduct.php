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

    public function getOrdersList ()
    {
        return OrderProduct::find()->asArray()->all();
    }


    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['price', 'sum'], 'double'],
            [['name'], 'string', 'max' => 255],
        ];
    }

}
