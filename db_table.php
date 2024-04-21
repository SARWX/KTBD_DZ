<?php
class db_table 
{
    var $table_name;		// Имя таблицы
    var $attributes;		// Атрибуты таблицы
	
	function db_table($table_name, $attributes) 	 // Вместо __construct()
	{
        $this->table_name = $table_name;
        $this->attributes = $attributes;
    }
	
	function get_data($oracleDB) {
    $query = "SELECT * FROM {$this->table_name}";
    $result = $oracleDB->execute($query);

    $data = array();
    while (ocifetchinto($result, $row, OCI_ASSOC)) {
        $row_data = array();
        foreach ($row as $key => $value) {
            $row_data[$key] = ociresult($result, $key);
        }
        $data[] = $row_data;
    }
    return $data;
}

	// Функция для экранирования значений
	function quote_value($value) 
	{
		return "'" . addslashes($value) . "'";
	}
	// 
    function add_data($oracleDB, $data) 
	{
    $table_name = $this->table_name;
    $columns = implode(', ', array_keys($data));
    $values = implode(', ', array_map(array($this, 'quote_value'), array_values($data)));

    $query = "INSERT INTO {$table_name} ({$columns}) VALUES ({$values})";
	echo $query;
     $result = $oracleDB->execute($query);
	// // Сохраним изменения
	// $query = "commit";
	 // $result = $oracleDB->execute($query);
	// $query = "select sin(3.14) from dual";
	 // $result = $oracleDB->execute($query);
	 // $query = "SELECT * FROM {$this->table_name}";
    // $result = $oracleDB->execute($query);
	}



     function edit_data($data, $condition) 
	 {
        // Подготовьте и выполните запрос на изменение данных в таблице
        // Например:
        // $query = "UPDATE $this->table_name SET ... WHERE $condition";
        // $result = $db->execute($query);
        // return $result;
    }
}
?>