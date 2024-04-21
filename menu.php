<!DOCTYPE html>
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
	// Открываем соединение
	$oracleDB = new OracleDB();
	if ($oracleDB->open_conn()) 
	{	
		// Проверяем, установлена ли переменная сессии для пользователя
		if (isset($_SESSION['user'])) 
		{
			// Если установлена, приветствуем пользователя
			echo "Добро пожаловать, " . $_SESSION['user']['name'] . "!";
			
			// Создаем экземпляр класса DbTable с названием таблицы "personal" и массивом атрибутов
			$personal = new db_table('personal', array('per_surname', 'per_id', 'per_dep_id', 'per_name', 'per_post', 'per_email', 'per_password', 'per_salary'));
			// Получаем данные из таблицы
			$rows = $personal->get_data($oracleDB);

			// Формируем HTML-таблицу
			echo "<table border='1'>";
			// echo "<tr><th>per_surname</th><th>per_id</th><th>per_dep_id</th><th>per_name</th><th>per_post</th><th>per_email</th><th>per_password</th><th>per_salary</th></tr>";
			echo "<tr>";
			foreach ($personal->attributes as $attribute) {
				echo "<th>{$attribute}</th>";
			}
			echo "</tr>";
			
			foreach ($rows as $row) 
			{
				echo "<tr>";
				foreach ($row as $value) 
				{
					echo "<td>{$value}</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			
		} 
		else 
		{
			// Если переменная сессии не установлена, перенаправляем пользователя на страницу авторизации
			header("Location: ../index.php");
			exit;
		}
	} 
	else 
	{
        // В случае ошибки соединения выводим сообщение об ошибке
        echo "Ошибка соединения с базой данных.";
    }
    ?>
</body>
</html>
