<?
    use yii\helpers\Url;

    $this->title = 'Dianas jewelry | интернет магазин ювелирных изделий';
?>

<div id="slider">
    <ul>
        <li style="background-image: url(/images/0.jpg)">
            <h3>Сделай свою жизнь лучше</h3>
            <h2>подлинные бриллианты</h2>
            <a href="#" class="btn-more">Перейти</a>
        </li>
        <li class="purple" style="background-image: url(/images/01.jpg)">
            <h3>Она обязательно скажет “да”</h3>
            <h2>обручальное кольцо</h2>
            <a href="/category/rings" class="btn-more">Перейти</a>
        </li>
        <li class="yellow" style="background-image: url(/images/02.jpg)">
            <h3>Вы достойны быть красавицей</h3>
            <h2>золотые браслеты</h2>
            <a href="/category/bracelets" class="btn-more">Перейти</a>
        </li>
    </ul>
</div>
<!-- / body -->

<div id="body">
    <div class="container">
        <div class="last-products">
            <h2>Последние поступления</h2>
            <section class="products">
                <? foreach($products as $product) {
                if (Yii::$app->user->isGuest) {
                    $price = $product['price'];
                } else {
                    $price = $product['price'] - ($product['price']) * 10 / 100;
                }?>
                    <article>

                        <? $promo = $allProducts->getProductPromo($product['alias']); ?>
                        <a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><img src="/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                        <h3><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['name'] ?></a></h3>
                        <div><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['short_description'] ?></a></div>
                        <? if ($promo != $price) { ?>
                            <h4 style="padding: 0;"><a style="color: mediumseagreen;" href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>">&#8381; <?= number_format($allProducts->getProductPromo($product['alias']), 2, '.', ' ') ?></a></h4>
                            <h4 style="text-decoration: line-through; font-size: 20px;"><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>">&#8381; <?= number_format($price, 2, '.', ' ') ?></a></h4>
                        <? } else { ?>
                            <h4 style="padding: 0;"><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>">&#8381; <?= number_format($price, 2, '.', ' ') ?></a></h4>
                            <h4><a style="color: mediumseagreen;" href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>">&nbsp;</a></h4>
                        <? } ?>

                        <a href="#"  data-alias="<?= $product['alias'] ?>" class="btn-add">В корзину</a>
                    </article>
                <? } ?>
            </section>
        </div>
        <section class="quick-links">
            <article style="background-image: url(images/2.jpg)">
                <a href="#" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>Lorem ipsum</h4>
                            <hr>
                            <h3>Dolor sit amet</h3>
                        </div>
                    </div>
                </a>
            </article>
            <article class="red" style="background-image: url(images/3.jpg)">
                <a href="#" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>consequatur</h4>
                            <hr>
                            <h3>voluptatem</h3>
                            <hr>
                            <p>Accusantium</p>
                        </div>
                    </div>
                </a>
            </article>
            <article style="background-image: url(images/4.jpg)">
                <a href="#" class="table">
                    <div class="cell">
                        <div class="text">
                            <h4>culpa qui officia</h4>
                            <hr>
                            <h3>magnam aliquam</h3>
                        </div>
                    </div>
                </a>
            </article>
        </section>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

