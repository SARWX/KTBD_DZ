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
    function open_conn() 
	{
        $this->connection = OCILogon($this->login, $this->password, $this->DB_name, $this->text_encode);
        return $this->connection;
    }
    
    // Закрытие соединения с базой данных
    function close_conn() 
	{
        OCILogoff($this->connection);
    }
    
	// Выволнение запроса
	function execute($query) 
	{
		$this->statement = OCIParse($this->connection, $query);
		OCIExecute($this->statement);
		return $this->statement;
	}

	// Получение ассоциативного массива с данными из результата запроса
	function fetch_assoc($result) 
	{
		// Используем OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC для получения ассоциативного массива
		return OCIFetchStatement($result, $row, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    }
	
	// Получение количества строк в результате запроса
	function num_rows($query) 
	{
		return OCIRowCount($query);
	}
}
?>
</body>
</html>