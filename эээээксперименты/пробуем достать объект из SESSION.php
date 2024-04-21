<!DOCTYPE html>
<head>
    <meta charset="RU8PC866">
    <title>авторизация</title>
</head>
<body>
<?php
class OracleDB {
    var $login = "novikov";
    var $password = "subaruwrx";
    var $DB_name = ""; // Имя сервиса базы данных
    var $text_encode = "RU8PC866"; // Кодировка текста
    var $query; // Запрос
    
    var $connection; // Соединение с базой данных
    var $statement; // Выражение
    
    // Открытие соединения с базой данных
    function open_conn() {
        $this->connection = OCILogon($this->login, $this->password, $this->DB_name, $this->text_encode);
        return $this->connection;
    }
    
    // Закрытие соединения с базой данных
    function close_conn() {
        OCILogoff($this->connection);
    }
    
	// Выволнение запроса
	function execute($query) {
		$this->statement = OCIParse($this->connection, $query);
		OCIExecute($this->statement);
		return $this->statement;
	}

    
    // Получение ассоциативного массива с данными из результата запроса
    // function fetch_assoc($result) {
        // return OCIFetchInto($result, $row, OCI_ASSOC);
		
	// Получение ассоциативного массива с данными из результата запроса
	function fetch_assoc($result) {
		// Используем OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC для получения ассоциативного массива
		return OCIFetchStatement($result, $row, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    }
	
	// Получение количества строк в результате запроса
	function num_rows($query) {
		return OCIRowCount($query);
}
}
?>
</body>
</html>












<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="RU8PC866">
    <title>Меню</title>
</head>
<body>
    <?php
	require_once('db_table.php');		// Класс таблицы
	require_once('conn_bd.php');		// Класс таблицы
	include ('auth.php');			// объект $oracleDB
	session_start();
	$oracleDB = $_SESSION['oracleDB'];
	    

	
    // Проверяем, установлена ли переменная сессии для пользователя
    if (isset($_SESSION['user'])) {
        // Если установлена, приветствуем пользователя
        echo "Добро пожаловать, " . $_SESSION['user']['name'] . "!";
		
		
		
		// Создаем экземпляр класса DbTable с названием таблицы "personal" и массивом атрибутов
		$personal = new db_table('personal', array('per_surname', 'per_id', 'per_dep_id', 'per_name', 'per_post', 'per_email', 'per_password', 'per_salary'));
		$query = $personal->get_data();
		echo $personal->name();
		echo $query;
		$oracleDB->execute($query);
		
		// Рисуем меню
		// dysplay(
		
		
		
		
		
		
		
		
		
		
		
		
		
    } else {
        // Если переменная сессии не установлена, перенаправляем пользователя на страницу авторизации
        header("Location: ../index.php");
        exit;
    }
    ?>
</body>
</html>
