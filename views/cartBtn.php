<div class="cart">
    <a href="/cart/" class="btn-cart" type="button">Корзина</a>
    <div class="auth">
        <? if ($auth):?>
        <div>
            <span><?=$username?></span><a href="/auth/logout/">Выход</a>
        </div>
        <? else: ?>
        <a href="/auth/">Вход</a>
        <a href="#">Регистрация</a>
        <?endif;?>
    </div>
</div>
