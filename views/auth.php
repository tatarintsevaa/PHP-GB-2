<h1 class="section-name">Вход</h1>
<? if ($action == 'signIn'):?>
<form class="auth-block" action="/auth/login/" method="post">
    <? if (isset($backpath)):?>
        <input type="hidden" name="backpath" value="<?=$backpath?>">
    <?else:?>
        <input type="hidden" name="backpath" value="<?=$_SERVER['HTTP_REFERER']?>">
    <?endif;?>
    <input class="input" type="text" name="login" placeholder="Логин">
    <input class="input" type="text" name="pass" placeholder="Пароль">
    <div class="auth-block_btn">
        <p>Запомнить? <input type="checkbox" name="save"></p>
        <input class="btn" type="submit" name="submit" value="Войти">
    </div>
</form>
<?elseif ($action == 'signUp'):?>
<form class="auth-block" action="/auth/registration/" method="post">
    <? if (isset($backpath)):?>
        <input type="hidden" name="backpath" value="<?=$backpath?>">
    <?else:?>
        <input type="hidden" name="backpath" value="<?=$_SERVER['HTTP_REFERER']?>">
    <?endif;?>
    <input class="input" type="text" name="login" placeholder="Логин">
    <input class="input" type="text" name="pass" placeholder="Пароль">
    <input class="btn" type="submit" name="submit" value="Регистрация">
    <? if (isset($message)):?>
    <p><?=$message?></p>
    <?endif;?>
</form>
<? endif; ?>