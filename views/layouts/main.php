<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use app\widgets\MenuWidget;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="/images/favicon.ico">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header id="header">
    <div class="container">
        <a href="/" id="logo" title="Diana’s jewelry">Diana’s jewelry</a>
        <form action="<?= Url::to(['category/search']) ?>" method="get">
            <input type="text" class="search" placeholder="Поиск..." name="search">
            <input type="submit" value="" class="search-btn">
        </form>
        <div class="right-links">
            <ul>
                <li>
                    <a href="/cart"><span class="ico-products"></span>
                        Товаров: <span class="menu-total-quantity"><?= $_SESSION['cart.totalQuantity'] ? $_SESSION['cart.totalQuantity'] : 0 ?></span>
                        , &#8381;<span class="menu-total-sum"><?= $_SESSION['cart.totalSum'] ? number_format($_SESSION['cart.totalSum'], 2, '.', ' ') : 0 ?></span>
                    </a>
                </li>
                <? if (Yii::$app->user->isGuest) { ?>
                    <li><a href="/login"><span class="ico-signout"></span>Войти</a></li>
                    <li><a href="/signup"><span class="ico-account"></span>Регистрация</a></li>
                <? } else if (Yii::$app->user->identity->is_admin === 1) { ?>
                    <li><a href="/admin"><span class="ico-account"></span>Панель администратора</a></li>
                    <li><a href="/mycabinet"><span class="ico-account"></span>Личный кабинет</a></li>
                    <li><a href="/logout"><span class="ico-signout"></span>Выход</a></li>
                <? } else { ?>
                    <li><a href="/mycabinet"><span class="ico-account"></span>Личный кабинет</a></li>
                    <li><a href="/logout"><span class="ico-signout"></span>Выход</a></li>
                <? } ?>

            </ul>
        </div>
    </div>
    <!-- / container -->
</header>
<!-- / header -->

<?= MenuWidget::widget() ?>

<div class="content">
    <?= $content ?>
</div>

<footer id="footer">
    <div class="container">
        <div class="cols">
            <div class="col">
                <h3>Frequently Asked Questions</h3>
                <ul>
                    <li><a href="#">Fusce eget dolor adipiscing </a></li>
                    <li><a href="#">Posuere nisl eu venenatis gravida</a></li>
                    <li><a href="#">Morbi dictum ligula mattis</a></li>
                    <li><a href="#">Etiam diam vel dolor luctus dapibus</a></li>
                    <li><a href="#">Vestibulum ultrices magna </a></li>
                </ul>
            </div>
            <div class="col media">
                <h3>Social media</h3>
                <ul class="social">
                    <li><a href="#"><span class="ico ico-fb"></span>Facebook</a></li>
                    <li><a href="#"><span class="ico ico-tw"></span>Twitter</a></li>
                    <li><a href="#"><span class="ico ico-gp"></span>Google+</a></li>
                    <li><a href="#"><span class="ico ico-pi"></span>Pinterest</a></li>
                </ul>
            </div>
            <div class="col contact">
                <h3>Contact us</h3>
                <p>Diana’s Jewelry INC.<br>54233 Avenue Street<br>New York</p>
                <p><span class="ico ico-em"></span><a href="#">contact@dianasjewelry.com</a></p>
                <p><span class="ico ico-ph"></span>(590) 423 446 924</p>
            </div>
            <div class="col newsletter">
                <h3>Присоединяйтесь к нашей рассылке</h3>
                <p>Наши Акции и новости будут приходить непосредственно на Вашу почту.</p>
                <form id="subscribe-form" action="/subscribe" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input type="email" name="email" placeholder="Ваш email адрес..." required>
                    <button type="submit"></button>
                </form>

            </div>
        </div>
        <p class="copy">Copyright <?= date('Y') ?> Jewelry. Это сайт, созданный в учебных целях.</p>
    </div>
    <!-- / container -->
</footer>
<!-- / footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
