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
                <li><a href="cart.html"><span class="ico-products"></span>3 products, $4 500.00</a></li>
                <li><a href="#"><span class="ico-account"></span>Account</a></li>
                <li><a href="#"><span class="ico-signout"></span>Sign out</a></li>
            </ul>
        </div>
    </div>
    <!-- / container -->
</header>
<!-- / header -->

<?= MenuWidget::widget() ?>

<!--<div class="container">-->
    <?= $content ?>
<!--</div>-->

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
                <h3>Join our newsletter</h3>
                <p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium.</p>
                <form action="#">
                    <input type="text" placeholder="Your email address...">
                    <button type="submit"></button>
                </form>
            </div>
        </div>
        <p class="copy">Copyright <?= date('Y') ?> Jewelry. All rights reserved.</p>
    </div>
    <!-- / container -->
</footer>
<!-- / footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
