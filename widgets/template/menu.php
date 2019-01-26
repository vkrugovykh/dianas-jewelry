<?php
    use yii\helpers\Url;
?>

<nav id="menu">
    <div class="container">
        <div class="trigger"></div>
        <ul>
            <li><a href="products.html">Новинки</a></li>

            <? foreach ($data as $id) { ?>
                <li data-id="<?= $id['category_alias'] ?>"><a href="<?= Url::to(['category/view', 'id'=>$id['category_alias']]) ?>"><?= $id['category_name'] ?></a></li>
            <? } ?>

            <li><a href="products.html">Промо акции</a></li>
        </ul>
    </div>
    <!-- / container -->
</nav>
<!-- / navigation -->
