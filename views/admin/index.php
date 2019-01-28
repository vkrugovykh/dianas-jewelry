<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'name',
            'email:email',
            'phone',
            'address',
            'sum',
            ['attribute' => 'status',
                'value' => function($info) {
                    switch($info->status) {
                        case 'Новый':
                            $info->status = "<div style = 'color: red'>$info->status</div>";
                            break;
                        case 'Обработка':
                            $info->status = "<div style = 'color: blue'>$info->status</div>";
                            break;
                        case 'Доставка':
                            $info->status = "<div style = 'color: blueviolet'>$info->status</div>";
                            break;
                        case 'Завершен':
                            $info->status = "<div style = 'color: green'>$info->status</div>";
                            break;
                        case 'Отменен':
                            $info->status = "<div style = 'color: black'>$info->status</div>";
                            break;
                    }
                    return $info->status;
                },
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
