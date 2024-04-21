<?php
class db_table {
    var $table_name;		// Имя таблицы
    var $attributes;		// Атрибуты таблицы
	
	function db_table($table_name, $attributes) { // Вместо __construct()
        $this->table_name = $table_name;
        $this->attributes = $attributes;
    }

	function name() {
		return $this->table_name;
	}
	
     // function get_data($condition = '') {
        // $query = "SELECT * FROM $this->table_name";
        // if (!empty($condition)) {
            // $query .= " WHERE $condition";
        // }
											// // Здесь выполните запрос к базе данных и верните результат
											// // $result = $db->execute($query);
											// // return $result;
		// return $query;
    // }
	
	
	
	
	
	
	
	
	
	
	
	
	function get_data($oracleDB) {
    $query = "SELECT * FROM {$this->table_name}";
	$result = $oracleDB->execute($query);
    // $result = $this->execute($query);

    $data = array();
    while (ocifetchinto($result, $row, OCI_ASSOC)) {
        $data[] = array(
            'per_surname' => ociresult($result, "PER_SURNAME"),
            'per_id' => ociresult($result, "PER_ID"),
            'per_dep_id' => ociresult($result, "PER_DEP_ID"),
            'per_name' => ociresult($result, "PER_NAME"),
            'per_post' => ociresult($result, "PER_POST"),
            'per_email' => ociresult($result, "PER_EMAIL"),
            'per_password' => ociresult($result, "PER_PASSWORD"),
            'per_salary' => ociresult($result, "PER_SALARY")
        );
    }
    return $data;
}

	
	
	
	
	
	

     function add_data($data) {
        // Подготовьте и выполните запрос на добавление данных в таблицу
        // Например:
        // $query = "INSERT INTO $this->table_name (...) VALUES (...)";
        // $result = $db->execute($query);
        // return $result;
    }

     function edit_data($data, $condition) {
        // Подготовьте и выполните запрос на изменение данных в таблице
        // Например:
        // $query = "UPDATE $this->table_name SET ... WHERE $condition";
        // $result = $db->execute($query);
        // return $result;
    }
}
?>