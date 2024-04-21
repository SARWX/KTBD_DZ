<!DOCTYPE html>
<head>
    <meta charset="RU8PC866">
    <title>авторизации</title>
</head>
<body>
<?php
if (!empty($_POST["login"]) && !empty($_POST["pass"])) {
    include "./conn_bd.php";
    
    // Получаем данные из формы
    $login = $_POST['login'];
    $password = $_POST['pass'];
    
    // Создаем экземпляр класса OracleDB
    require_once "./conn_bd.php";
    $oracleDB = new OracleDB();
	global $oracleDB;
	$_SESSION['oracleDB'] = $oracleDB;
    
	session_start();
	
    // Открываем соединение с базой данных
    if ($oracleDB->open_conn()) {
        // Создаем SQL запрос с использованием параметров
        $query = "SELECT * FROM Personal WHERE per_email = '$login' AND per_password = '$password'";
		$result = $oracleDB->execute($query);

        
		echo $result;
		echo $oracleDB->num_rows($result);
		
        // Проверяем, есть ли строки в результате запроса
        // if ($result && $oracleDB->num_rows($result) > 0) {
			if (OCIFetch($result)) {				
            // Извлекаем данные из результата
			$id = ociresult($result, "PER_ID");
			$name = ociresult($result, "PER_NAME");
			$surname = ociresult($result, "PER_SURNAME");
			$status = ociresult($result, "PER_STATUS");
			$func = ociresult($result, "PER_FUNC");

            // Сохраняем данные в сессию
            $_SESSION['user'] = array(
                "id"       => $id,
                "name"     => $name,
                "surname"  => $surname,
                "status"   => $status,
                "func"     => $func
            );

            // Перенаправляем на страницу меню
            header('Location: ./menu.php');
            exit;
        } 
		// else {
          // // Перенаправляем на страницу авторизации с сообщением об ошибке
            // $login = urlencode($login);
            // header("Location: ../index.php?m=1&login=$login");
            // exit;
        // }
    } else {
        // В случае ошибки соединения выводим сообщение об ошибке
        echo "Ошибка соединения с базой данных.";
    }
}
?>
</body>
</html>