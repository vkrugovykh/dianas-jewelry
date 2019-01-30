<?
    use yii\helpers\Url;

    $this->title = 'Dianas jewelry | интернет магазин ювелирных изделий | Новинки';

?>

<div id="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="/">Главная</a></li>
            <li>Новинки</li>
        </ul>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

<div id="body">
    <div class="container">

        <div class="products-wrap">
            <div id="content">
                <section class="products" style="padding-left: 1px">

                    <? foreach($products as $product) {
                        if (Yii::$app->user->isGuest) {
                            $price = $product['price'];
                        } else {
                            $price = $product['price'] - ($product['price']) * 10 / 100;
                        }?>
                        <article style="width: 234px">
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
            <!-- / content -->
        </div>

    </div>
    <!-- / container -->
</div>
<!-- / body -->