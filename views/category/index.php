<?
    use yii\helpers\Url;

    $this->title = 'Dianas jewelry | интернет магазин ювелирных изделий';
?>

<div id="slider">
    <ul>
        <li style="background-image: url(images/0.jpg)">
            <h3>Make your life better</h3>
            <h2>Genuine diamonds</h2>
            <a href="#" class="btn-more">Read more</a>
        </li>
        <li class="purple" style="background-image: url(images/01.jpg)">
            <h3>She will say “yes”</h3>
            <h2>engagement ring</h2>
            <a href="#" class="btn-more">Read more</a>
        </li>
        <li class="yellow" style="background-image: url(images/02.jpg)">
            <h3>You deserve to be beauty</h3>
            <h2>golden bracelets</h2>
            <a href="#" class="btn-more">Read more</a>
        </li>
    </ul>
</div>
<!-- / body -->

<div id="body">
    <div class="container">
        <div class="last-products">
            <h2>Last added products</h2>
            <section class="products">
                <? foreach($products as $product) { ?>
                    <article>
                        <a href="product.html"><img src="/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                        <h3><a href="product.html"><?= $product['name'] ?></a></h3>
                        <div><a href="product.html"><?= $product['short_description'] ?></a></div>
                        <h4><a href="product.html">&#8381; <?= number_format($product['price'], 2, '.', ' ') ?></a></h4>
                        <a href="cart.html" class="btn-add">В корзину</a>
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

