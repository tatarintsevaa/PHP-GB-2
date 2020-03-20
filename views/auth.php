<h1>Вход</h1>
<form action="/auth/login/" method="post">
    <input type="hidden" name="backpath" value="<?=$_SERVER['HTTP_REFERER']?>">
    <input type="text" name="login" placeholder="Логин">
    <input type="text" name="pass" placeholder="Пароль">
    Запомнить? <input type="checkbox" name="save">
    <input type="submit" name="submit" value="Войти">
</form>