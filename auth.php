<?php
session_start();

if (!empty($_POST["login"]) && !empty($_POST["pass"])) {
    include "./conn_bd.php";
    $login = $_POST['login'];
    $password = $_POST['pass'];
    
    $select = "SELECT * FROM Personal WHERE per_email = :login AND per_password = :password";
    $check_user = OCIParse($c, $select);
    OCIBindByName($check_user, ":login", $login);
    OCIBindByName($check_user, ":password", $password);
    OCIExecute($check_user, OCI_DEFAULT);
    
    // Проверяем, есть ли строки в результате запроса
    if (OCIFetch($check_user)) {
        // Извлекаем данные из текущей строки результата
        $id = ociresult($check_user, "PER_ID");
        $name = ociresult($check_user, "PER_NAME");
        $surname = ociresult($check_user, "PER_SURNAME");
        $status = ociresult($check_user, "PER_STATUS");
        $func = ociresult($check_user, "PER_FUNC");

        // Сохраняем данные в сессию
        $_SESSION['user'] = array(
            "id"       => $id,
            "name"     => $name,
            "surname"  => $surname,
            "status"   => $status,
            "func"     => $func
        );

        header('Location: ./menu.php');
        exit;
    } else {
    $login = urlencode($_POST['login']);
    header("Location: ../index.php?m=1&login=$login");
    exit;
    }
}
?>
