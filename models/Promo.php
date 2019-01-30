<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 29.01.2019
 * Time: 18:31
 */

namespace app\models;


use yii\db\ActiveRecord;

class Promo extends ActiveRecord
{

    //Название таблицы
    public static function tableName()
    {
        return 'promo';
    }

    //Получаем все акционные товары
    public function getPromo()
    {
        return Promo::find()->asArray()->all();
//        return Promo::find()->asArray()->all();
    }

    //Получаем акцию товара
    public function getPromoOfProduct($id) {
        $promo = Promo::find()->where(['product_id' => $id])->asArray()->one()['percent'];
        $data = (!$promo) ? 0 : $promo;
        return $data;
    }

}