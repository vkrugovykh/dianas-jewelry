<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 25.01.2019
 * Time: 20:44
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{

    //Название таблицы
    public static function tableName()
    {
        return 'category';
    }

    //Получаем все категории
    public function getCategories()
    {
        return Category::find()->orderBy(['category_order'=>SORT_ASC])->asArray()->all();
    }

    //Получаем название нужной категории
    public function getCategoryTitle($id)
    {
        return Category::find()->where(['category_alias' => $id])->one();
    }

}