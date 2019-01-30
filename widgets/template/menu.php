<?php
    use yii\helpers\Url;
?>

<nav id="menu">
    <div class="container">
        <div class="trigger"></div>
        <ul>
            <li data-id="new"><a href="/category/new">Новинки</a></li>

            <? foreach ($data as $id) { ?>
                <li data-id="<?= $id['category_alias'] ?>"><a href="<?= Url::to(['category/view', 'id'=>$id['category_alias']]) ?>"><?= $id['category_name'] ?></a></li>
            <? } ?>

            <li data-id="promo"><a href="/category/promo">Промо акции</a></li>
        </ul>
    </div>
    <!-- / container -->
</nav>
<!-- / navigation -->
