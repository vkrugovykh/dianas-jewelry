<?
use yii\helpers\Url;

if ($_POST) {
    Yii::$app->response->redirect(Url::to('/cart/order/'));
}

//echo '<pre>';
//var_dump($session['lastOrderOrderItems']);
//echo '</pre>';

?>

<!--$session->set('lastOrderName', $order->name);-->
<!--$session->set('lastOrderEmail', $order->email);-->
<!--$session->set('lastOrderPhone', $order->phone);-->
<!--$session->set('lastOrderAddress', $order->address);-->
<!--$session->set('lastOrderOrderItems', $session['cart']);-->
<!--$session->set('lastOrderTotalQuantity', $session['cart.totalQuantity']);-->
<!--$session->set('lastOrderTotalSum', $session['cart.totalSum']);-->

<div id="body">
    <div class="modal-success">
        <a href="/" class="popup-close">×</a>

        <div class="popup-success">


        <div class="success-info">

            <h3>Спасибо, Ваш заказ под номером <?= $session['currentId'] ?> принят!</h3>
            <p><strong>Имя: </strong><?= $session['lastOrderName'] ?></p>
            <p><strong>E-mail: </strong><?= $session['lastOrderEmail'] ?></p>
            <p><strong>Телефон: </strong><?= $session['lastOrderPhone'] ?></p>
            <p><strong>Адрес: </strong><?= $session['lastOrderAddress'] ?></p>

            <div class="cart-table">
                <table>
                    <tr>
                        <th class="items">Товар</th>
                        <th class="price">Цена</th>
                        <th class="qnt">Количество</th>
                        <th class="total">Стоимость</th>
                    </tr>
                    <? foreach ($session['lastOrderOrderItems'] as $id => $product) { ?>
                        <tr>
                            <td class="items">
                                <div class="image">
                                    <img src="/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                                </div>
                                <h3><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['name'] ?></a></h3>
                                <p><?= $product['short_description'] ?></p>
                            </td>
                            <td class="price">&#8381;<?= number_format($product['price'], 2, '.', ' ') ?></td>

                            <td class="qnt"><?= $product['productQuantity'] ?></td>
                            <td class="total">&#8381;<?= number_format($product['price'] * $product['productQuantity'], 2, '.', ' ') ?></td>
                        </tr>
                    <? } ?>
                </table>
            </div>

            <p><strong>Итого: </strong><?= $session['lastOrderTotalQuantity'] ?> шт.</p>
            <p><strong>На сумму: </strong><?= $session['lastOrderTotalSum'] ?> рублей.</p>
            <a href="/" class="btn-grey">Закрыть</a>
        </div>
        </div>
    </div>
</div>