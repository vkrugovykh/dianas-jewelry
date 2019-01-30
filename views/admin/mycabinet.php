<?
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
    <div id="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="/">Главная</a></li>
                <li>Мои заказы</li>
            </ul>
        </div>
        <!-- / container -->
    </div>
    <!-- / body -->

<? if ($usersOrder) { ?>

    <div id="body">
        <div class="container">
            <div id="content" class="full">
                <div class="cart-table">
                    <table>
                        <tr>
                            <th>Заказ</th>
                            <th>Дата, время</th>
                            <th>Сумма</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Телефон</th>
                            <th>Адрес</th>
                            <th>Статус</th>
                        </tr>
                        <? foreach ($usersOrder as $order) { ?>

                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['date'] ?></td>
                                <td><?= $order['sum'] ?></td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['email'] ?></td>
                                <td><?= $order['phone'] ?></td>
                                <td><?= $order['address'] ?></td>
                                <td><?= $order['status'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <h3>Состав заказа:</h3>
                                    <? foreach ($orderList as $product) {
                                        if ($product['order_id'] == $order['id']) { ?>
                                            <div> - <?= $product['name'] ?> в количестве <?= $product['quantity'] ?>шт. на сумму <?= $product['sum'] ?> рублей.</div>
                                    <? }} ?>
                                </td>
                            </tr>
                        <? } ?>
                    </table>
                </div>

            </div>
            <!-- / content -->
        </div>
        <!-- / container -->
    </div>
    <!-- / body -->
<? } else { ?>
    <div id="body">
        <div class="container">
            <div class="empty-cart">
                <h3>У Вас еще нет заказов :( </h3>
                <a href="/" class="btn-grey">Начать покупки</a>
            </div>
        </div>
    </div>
<? } ?>