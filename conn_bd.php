<?php
// Параметры подключения к базе данных Oracle
$db_user = "novikov"; // Имя пользователя
$db_pass = "subaruwrx"; // Пароль
$db_name = ""; // Имя сервиса базы данных

echo "TEST";
// Подключение к базе данных Oracle
$c = OCILogon($db_user, $db_pass);

// Проверка соединения
if (!$c) {
    $err = OCIError();
    echo "Ошибка подключения к базе данных: " . $err['message'];
    exit;
}
?>
