<?
    use yii\helpers\Url;

    $this->title = 'Dianas jewelry | интернет магазин ювелирных изделий';

    if (Yii::$app->user->isGuest) {
        $price = $product['price'];
    } else {
        $price = $product['price'] - ($product['price']) * 10 / 100;
    }

    $promo = $allProducts->getProductPromo($product['alias']);
?>

<div id="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="#">Home</a></li>
            <li>Product page</li>
        </ul>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

<div id="body">
    <div class="container">
        <div id="content" class="full">
            <div class="product">
                <div class="image">
                    <img src="/images/<?= $product['img']; ?>" alt="">
                </div>
                <div class="details">
                    <h1><?= $product['name']; ?></h1>

                    <? if ($promo != $price) { ?>
                        <h4 style="color: mediumseagreen; display: inline-block; padding-right: 20px;">&#8381; <?= number_format($promo, 2, '.', ' ') ?></h4>
                        <h4 style="text-decoration: line-through; font-size: 24px; display: inline-block;">&#8381; <?= number_format($price, 2, '.', ' ') ?></h4>
                    <? } else { ?>
                        <h4>&#8381;<?= number_format($price, 2, '.', ' ') ?></h4>
                    <? } ?>

<!--                    <h4>&#8381;--><?//= number_format($price, 2, '.', ' ') ?><!--</h4>-->
                    <div class="entry">
                        <p><?= $product['short_description']; ?></p>
                        <div class="tabs">
                            <div class="nav">
                                <ul>
                                    <li class="active"><a href="#desc">Описание</a></li>
                                    <li><a href="#spec">Характеристики</a></li>
                                    <li><a href="#ret">Возврат</a></li>
                                </ul>
                            </div>
                            <div class="tab-content active" id="desc">
                                <p><?= $product['description']; ?></p>
                            </div>
                            <div class="tab-content" id="spec">
                                <p><?= $product['specification']; ?></p>
                            </div>
                            <div class="tab-content" id="ret">
                                <p><?= $returns['content']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <label>Количество:</label>
                        <select>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>

                        <a href="#"  data-alias="<?= $product['alias'] ?>" class="btn-add btn-grey">В корзину</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- / content -->
    </div>
    <!-- / container -->
</div>
<!-- / body -->