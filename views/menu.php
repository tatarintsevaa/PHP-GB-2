<ul class="menu">
    <li><a href="/">Главная</a></li>
    <li><a href="/product/catalog/">Каталог</a></li>
    <? if ($isAdmin):?>
    <li><a href="/admin/">Админка</a></li>
    <li><a href="/adminCatalog/">Админка каталога</a></li>
    <?endif;?>
</ul>