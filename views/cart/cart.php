<?
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Dianas jewelry | Корзина';

?>
<div id="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="/">Главная</a></li>
            <li>Корзина</li>
        </ul>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

<? if ($session['cart']) { ?>

<div id="body">
    <div class="container">
        <div id="content" class="full">
            <div class="cart-table">
                <table>
                    <tr>
                        <th class="items">Товар</th>
                        <th class="price">Цена</th>
                        <th class="qnt">Количество</th>
                        <th class="total">Стоимость</th>
                        <th class="delete"></th>
                    </tr>
                    <? foreach ($session['cart'] as $id => $product) { ?>

                        <tr>
                            <td class="items">
                                <div class="image">
                                    <img src="/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                                </div>
                                <h3><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['name'] ?></a></h3>
                                <p><?= $product['short_description'] ?></p>
                            </td>
                            <td class="price">&#8381;<?= number_format($product['price'], 2, '.', ' ') ?></td>
                            <td class="qnt" data-alias="<?= $product['alias'] ?>" data-id="<?= $id ?>"><select>
                                <? for ($i = 1; $i <= 5; $i++) {
                                    if ($i == $product['productQuantity']) { ?>
                                        <option selected><?= $i ?></option>
                                    <? } else { ?>
                                        <option><?= $i ?></option>
                                <? }} ?>
                                </select></td>
                            <td class="total">&#8381;<?= number_format($product['price'] * $product['productQuantity'], 2, '.', ' ') ?></td>
                            <td class="delete" data-id="<?= $id ?>"><span class="ico-del"></span></td>
                        </tr>
                    <? } ?>
                    <tr>
                        <td colspan="5" align="center">
                            <a href="#" class="btn-cart-clear btn-grey" onclick="clearCart(event, true)">Очистить корзину</a>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="total-count">
                <h4 class="total-quantity">Всего товаров: <?= $session['cart.totalQuantity'] ?></h4>
                <h4 class="total-sum">Стоимость: &#8381;<?= number_format($session['cart.totalSum'], 2, '.', ' ') ?></h4>
                <p>+доставка: &#8381;<?= number_format(30, 2, '.', ' ') ?></p>
                <h3>Всего к оплате: <strong>&#8381;<?= number_format($session['cart.totalSum'] + 30, 2, '.', ' ') ?></strong></h3>
                <!-- имя адрес телефон почта-->
                <? $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['cart/order'],
                    'id' => 'checkout-form',
                ]) ?>

                <?= $form->field($order, 'name') ?>
                <?= $form->field($order, 'email') ?>
                <?= $form->field($order, 'phone') ?>
                <?= $form->field($order, 'address') ?>

                <?= Html::submitButton('Оформить заказ', ['class' => 'btn-checkout btn-grey']) ?>

                <? $form = ActiveForm::end() ?>

<!--                <a href="#" class="btn-checkout btn-grey">Оформить заказ</a>-->
                <!--модальное окно с благодарностью за заказ
                уникальный номер заказа
                состав заказа
                вся инфа которую вводил пользователь

                очистить форму после отправки
                -->

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
                <h3>В вашей корзине ничего нет :( </h3>
                <a href="/" class="btn-grey">Начать покупки</a>
            </div>
        </div>
    </div>
<? } ?>