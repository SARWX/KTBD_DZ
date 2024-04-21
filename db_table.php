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


     function add_data($data) 
	 {
        // Подготовьте и выполните запрос на добавление данных в таблицу
        // Например:
        // $query = "INSERT INTO $this->table_name (...) VALUES (...)";
        // $result = $db->execute($query);
        // return $result;
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