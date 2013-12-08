<?php

require_once('./config.php');

//$mysqli = (!empty($_GET['direction']) && $_GET['direction'] == 'destination') ? $destination : $source;

 $dbs = (!empty($_POST['dbs'])) ? $mysqli->real_escape_string(strip_tags($_POST['dbs'])) : NULL;
 $dbd = (!empty($_POST['dbd'])) ? $mysqli->real_escape_string(strip_tags($_POST['dbd'])) : NULL;
 $tbs = (!empty($_POST['tbs'])) ? $mysqli->real_escape_string(strip_tags($_POST['tbs'])) : NULL;
 $tbd = (!empty($_POST['tbd'])) ? $mysqli->real_escape_string(strip_tags($_POST['tbd'])) : NULL;
 $cs = (!empty($_POST['cs'])) ? $_POST['cs'] : NULL;

foreach ($cs as $column) {
	echo($column);
}
// if ($table && $db) {
// 	$query = 'SHOW COLUMNS FROM '.$db.'.'.$table;
// } else if ($db) {
// 	$query = 'SHOW TABLES FROM '.$db;
// } else {
// 	echo '<option>No database or table selected</option>';
// 	die;
// }

// $result = $mysqli->query($query);

// if ($result) {
// 	while ($row = $result->fetch_array()) {
// 		if ($table) {
// 			echo '<option value="'.$row['Field'].'">'.$row['Field'].'&nbsp;&nbsp;&nbsp;'.$row['Type'].'&nbsp;&nbsp;'.$row['Key'].'&nbsp;'.$row['Extra'].'</option>';
// 		} else {
// 			$q = 'SELECT COUNT(*) FROM '.$db.'.'.$row[0];
// 			$res = $mysqli->query($q);
// 			 if ($res) {
// 			 	$res = $res->fetch_array();
// 				$res = $res[0];
// 			 } else {
// 			 	$res = 0;
// 			 }
// 			echo '<option value="'.$row[0].'">'.$row[0].'&nbsp;&nbsp;&nbsp;Rows: '.$res.'</option>';
// 		}
// 	}
// }

// if ($mysqli) $mysqli->close();
// unset($mysqli);
?>