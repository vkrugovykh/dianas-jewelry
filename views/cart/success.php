<?
use yii\helpers\Url;

if ($_POST) {
    Yii::$app->response->redirect(Url::to('/cart/order/'));
}
?>

<div id="body">
    <div class="container">
        <div class="empty-cart">
            <h3>Спасибо, Ваш заказ под номером <?= $session['currentId'] ?> принят!</h3>
            <a href="/" class="btn-grey">Продолжить покупки</a>
        </div>
    </div>
</div>