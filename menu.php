<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="RU8PC866">
    <title>Меню</title>
</head>
<body>
    <?php
    session_start();

    // Проверяем, установлена ли переменная сессии для пользователя
    if (isset($_SESSION['user'])) {
        // Если установлена, приветствуем пользователя
        echo "Добро пожаловать, " . $_SESSION['user']['name'] . " " . $_SESSION['user']['surname'] . "!";
    } else {
        // Если переменная сессии не установлена, перенаправляем пользователя на страницу авторизации
        header("Location: ../index.php");
        exit;
    }
    ?>
</body>
</html>
