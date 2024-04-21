<!DOCTYPE html>
<head>
    <meta charset="RU8PC866">
    <title>Меню</title>
</head>
<body>

	<!-- Элементы управления -->
	<form action="update_mode.php" method="post">
    <!-- Ваши поля формы здесь -->

    <!-- Кнопка для отправки формы -->
	<button type="submit" name="table" value="personal">personal</button>
    <button type="submit" name="table" value="department">department</button>
	<button type="submit" name="table" value="project">project</button>
	<button type="submit" name="table" value="equipment">equipment</button>
	<button type="submit" name="table" value="product">product</button>
	<button type="submit" name="table" value="defect">defect</button>
	<button type="submit" name="table" value="components">components</button>
	</form>






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
			
			// Создаем экземпляры класса DbTable с названиями таблиц и массивами атрибутов
			$personal = new db_table('personal', array('per_id', 'per_surname', 'per_dep_id', 'per_name', 'per_post', 'per_email', 'per_password', 'per_salary'));
			$department = new db_table('department', array('dep_id', 'dep_name'));
			$project = new db_table('project', array('proj_id', 'proj_name', 'proj_dep_id', 'proj_name'));
			$equipment = new db_table('equipment', array('eq_id', 'eq_date_of_purchase', 'eq_function', 'eq_name', 'eq_dep_id'));
			$product = new db_table('product', array('prod_id', 'prod_manuf_stage', 'prod_proj_id', 'prod_name'));
			$defect = new db_table('defect', array('def_id', 'def_reason', 'def_description', 'def_name', 'def_prod_id')); 	
			$components = new db_table('components', array('comp_id', 'comp_price', 'comp_number', 'comp_prod_id', 'comp_name'));
			
			// Создаем ассоциативный массив объектов
			$table_array = array(
				'personal' => $personal,
				'department' => $department,
				'project' => $project,
				'equipment' => $equipment,
				'product' => $product,
				'defect' => $defect,
				'components' => $components,
			);
			// Получить текущую таблицу
			$cur_table = $table_array[$_SESSION['table']];
			
			
			
			
			
			
			// Отображение таблицы mode = get
			if ($_SESSION['mode'] == 'get') 
			{
				// Получаем данные из таблицы
				$rows = $cur_table->get_data($oracleDB);

				// Формируем HTML-таблицу
				echo "<table border='1'>";
				echo "<tr>";
				foreach ($cur_table->attributes as $attribute) {
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
			
			
			
			// Отображение таблицы для добавления записи mode = add
			if ($_SESSION['mode'] == 'add') 
			{
				$data = parse_get_values_for_add();
				$cur_table->add_data($oracleDB, $data);
				// Формируем HTML-таблицу
				echo "<form action='#' method='GET' accept-charset='RU8PC866'>";
				echo "<table border='1'>";
				echo "<tr>";
				echo "<th>Поле: </th>";
				echo "<th>Введите значение</th>"; // Заголовок для столбца ввода значений
				echo "</tr>";

				// Создаем строки таблицы с полями для ввода значений
				foreach ($cur_table->attributes as $attribute) 
				{
					echo "<tr>";
					// Значение атрибута
					echo "<td>{$attribute}</td>";
					// Поле для ввода значения
					echo "<td><input type='text' name='{$attribute}'></td>";
					echo "</tr>";
				}
				
				// Добавляем строку для кнопки submit
				echo "<tr><td colspan='2'><input type='submit' value='Добавить запись'></td></tr>";
				
				echo "</table>";
				echo "</form>";
			}
			
			
			
			// TEST
			// TEST
			// TEST


			
			
			// Данные для вставки
			$data = array(
				'per_surname' => 'Петров',
				'per_id' => 124,
				'per_dep_id' => 457,
				'per_name' => 'Петр',
				'per_post' => 'Разработчик',
				'per_email' => 'petr@example.com',
				'per_password' => 'securepass321',
				'per_salary' => 60000
			);

			// Вызов функции для вставки данных
			// $personal->add_data($oracleDB, $data);
			
			
			// TEST
			// TEST
			// TEST
			
			
			
			
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
	
	
	
	
	
	// Функции
	function parse_get_values_for_add() 
	{
		$values = array();
		foreach ($_GET as $key => $value) {
			// Пропускаем ключ "mode"
			if ($key === 'mode') {
				continue;
			}
			// Добавляем значение в массив
			$values[$key] = $value;
		}
		return $values;
	}
	
	
    ?>
	
	
	
	
	
	
	<!-- Элементы управления -->
	<form action="update_mode.php" method="post">
    <!-- Ваши поля формы здесь -->

    <!-- Кнопка для отправки формы -->
	<button type="submit" name="mode" value="add">Добавить запись</button>
    <button type="submit" name="mode" value="get">Посмотреть записи</button>
	</form>
	
</body>
</html>
