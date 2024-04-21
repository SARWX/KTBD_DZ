<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="RU8PC866"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
<?php
// Проверяем наличие параметра m в URL и его значение
if (isset($_GET['m']) && $_GET['m'] == 1) 
{
    echo "Неверный логин или пароль";
}
?>

<h2>Форма авторизации</h2>
<form action="site/auth.php" method="POST">
    <label for="login">Логин:</label><br>
    <input type="text" name="login" <?php if(isset($_POST['login'])) echo "value='".$_POST['login']."'"; ?>><br>
    <label for="password">Пароль:</label><br>
    <input type="password" name="pass"><br>
    <input type="submit" value="Войти">
</form>

</form>

</body>
</html>
