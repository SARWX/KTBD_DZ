<?php
// Запускаем сессию
session_start();

// Проверяем, было ли отправлено значение mode
if (isset($_POST['mode'])) {
    // Устанавливаем значение mode в сессию
    $_SESSION['mode'] = $_POST['mode'];
}
if (isset($_POST['table'])) {
    // Устанавливаем значение mode в сессию
    $_SESSION['table'] = $_POST['table'];
}

// Возвращаемся на предыдущую страницу
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>