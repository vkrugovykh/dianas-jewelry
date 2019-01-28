<?
    use yii\helpers\Url;
    use yii\widgets\LinkPager;

    $this->title = 'Dianas jewelry | интернет магазин ювелирных изделий | ' . $title['category_name'];
    $pagination = LinkPager::widget([
                    'pagination' => $products['pagination'],
                    'activePageCssClass' => 'active',
                    'nextPageLabel' => '<span class="ico-next"></span>',
                    'prevPageLabel' => '<span class="ico-prev"></span>',
                    'prevPageCssClass' => '',
                    'nextPageCssClass' => '',
                    'disabledPageCssClass' => 'disabled',
                ]);
?>

<div id="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><?= $title['category_name'] ?></li>
        </ul>
    </div>
    <!-- / container -->
</div>
<!-- / body -->

<div id="body">
    <div class="container">

        <div class="pagination">
            <?= $pagination; ?>
        </div>

        <div class="products-wrap">
            <aside id="sidebar">
                <div class="widget">
                    <h3>Products per page:</h3>
                    <fieldset>
                        <input checked type="checkbox">
                        <label>8</label>
                        <input type="checkbox">
                        <label>16</label>
                        <input type="checkbox">
                        <label>32</label>
                    </fieldset>
                </div>
                <div class="widget">
                    <h3>Sort by:</h3>
                    <fieldset>
                        <input checked type="checkbox">
                        <label>Popularity</label>
                        <input type="checkbox">
                        <label>Date</label>
                        <input type="checkbox">
                        <label>Price</label>
                    </fieldset>
                </div>
                <div class="widget">
                    <h3>Condition:</h3>
                    <fieldset>
                        <input checked type="checkbox">
                        <label>New</label>
                        <input type="checkbox">
                        <label>Used</label>
                    </fieldset>
                </div>
                <div class="widget">
                    <h3>Price range:</h3>
                    <fieldset>
                        <div id="price-range"></div>
                    </fieldset>
                </div>
            </aside>
            <div id="content">
                <section class="products">

                    <? foreach($products['catProducts'] as $product) { ?>
                        <article>
                            <a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><img src="/images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>"></a>
                            <h3><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['name'] ?></a></h3>
                            <div><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>"><?= $product['short_description'] ?></a></div>
                            <h4><a href="<?= Url::to(['product/index', 'alias' => $product['alias']]) ?>">&#8381; <?= number_format($product['price'], 2, '.', ' ') ?></a></h4>
                            <a href="#"  data-alias="<?= $product['alias'] ?>" class="btn-add">В корзину</a>
                        </article>
                    <? } ?>

                </section>
            </div>
            <!-- / content -->
        </div>
        <div class="pagination">
            <?= $pagination; ?>
        </div>
    </div>
    <!-- / container -->
</div>
<!-- / body -->