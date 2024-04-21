<!DOCTYPE html>
<head>
    <meta charset="RU8PC866">
    <title>ЊҐ­о</title>
</head>
<body>
    <?php
	require_once('db_table.php');		// Љ« бб в Ў«Ёжл
	require_once('conn_bd.php');		// Љ« бб в Ў«Ёжл
	include ('auth.php');			// ®ЎкҐЄв $oracleDB
	session_start();
	// $oracleDB = $_SESSION['oracleDB'];
	$oracleDB = new OracleDB();
	if ($oracleDB->open_conn()) {
			

		
		// Џа®ўҐапҐ¬, гбв ­®ў«Ґ­  «Ё ЇҐаҐ¬Ґ­­ п бҐббЁЁ ¤«п Ї®«м§®ў вҐ«п
		if (isset($_SESSION['user'])) {
			// …б«Ё гбв ­®ў«Ґ­ , ЇаЁўҐвбвўгҐ¬ Ї®«м§®ў вҐ«п
			echo "„®Ўа® Ї®¦ «®ў вм, " . $_SESSION['user']['name'] . "!";
			
			
			
			// ‘®§¤ Ґ¬ нЄ§Ґ¬Ї«па Є« бб  DbTable б ­ §ў ­ЁҐ¬ в Ў«Ёжл "personal" Ё ¬ ббЁў®¬  ваЁЎгв®ў
			$personal = new db_table('personal', array('per_surname', 'per_id', 'per_dep_id', 'per_name', 'per_post', 'per_email', 'per_password', 'per_salary'));
			// $query = $personal->get_data($oracleDB);
			// echo $query;
			// $oracleDB->execute($query);
			
			// ђЁбгҐ¬ ¬Ґ­о
			// Џ®«гз Ґ¬ ¤ ­­лҐ Ё§ в Ў«Ёжл
			// $result = $personal->get_data();

			// Џ®«гз Ґ¬ ¤ ­­лҐ Ё§ в Ў«Ёжл
			$rows = $personal->get_data($oracleDB);

			// ”®а¬ЁагҐ¬ HTML-в Ў«Ёжг
			echo "<table border='1'>";
			echo "<tr><th>per_surname</th><th>per_id</th><th>per_dep_id</th><th>per_name</th><th>per_post</th><th>per_email</th><th>per_password</th><th>per_salary</th></tr>";

			foreach ($rows as $row) {
				echo "<tr>";
				foreach ($row as $value) {
					echo "<td>{$value}</td>";
				}
				echo "</tr>";
			}

			echo "</table>";
			
			
			
			
			

			
			
			
			
			
		
		
    } else {
        // …б«Ё ЇҐаҐ¬Ґ­­ п бҐббЁЁ ­Ґ гбв ­®ў«Ґ­ , ЇҐаҐ­ Їа ў«пҐ¬ Ї®«м§®ў вҐ«п ­  бва ­Ёжг  ўв®аЁ§ жЁЁ
        header("Location: ../index.php");
        exit;
    }
				} else {
        // ‚ б«гз Ґ ®иЁЎЄЁ б®Ґ¤Ё­Ґ­Ёп ўлў®¤Ё¬ б®®ЎйҐ­ЁҐ ®Ў ®иЁЎЄҐ
        echo "ЋиЁЎЄ  б®Ґ¤Ё­Ґ­Ёп б Ў §®© ¤ ­­ле.";
    }
    ?>
</body>
</html>
