<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 27.01.2019
 * Time: 0:16
 */

namespace app\models;

use yii\db\ActiveRecord;

class Returns extends ActiveRecord
{
    //Название таблицы с которой будем работать
    public static function tableName()
    {
        return 'returns';
    }

    //Получим одно условие возврата по id
    public function getOneReturn($id)
    {
        return Returns::find()->where(['id' => $id])->one();
    }
}