<?php

/**
 * DB table fields Copier v.1.0
 * @autor: Alex Lifantyev <al@arte.kz>
 */

require_once('./config.php');

$dbs = (!empty($_POST['dbs'])) ? $mysqli->real_escape_string(strip_tags($_POST['dbs'])) : NULL;
$dbd = (!empty($_POST['dbd'])) ? $mysqli->real_escape_string(strip_tags($_POST['dbd'])) : NULL;
$tbs = (!empty($_POST['tbs'])) ? $mysqli->real_escape_string(strip_tags($_POST['tbs'])) : NULL;
$tbd = (!empty($_POST['tbd'])) ? $mysqli->real_escape_string(strip_tags($_POST['tbd'])) : NULL;
$cs = (!empty($_POST['cs'])) ? $_POST['cs'] : NULL;
$ds = (!empty($_POST['ds'])) ? $_POST['ds'] : NULL;

$s = '';
foreach ($cs as $column) {
	$s = ($s == '') ? '`'.$column.'`' : $s.', `'.$column.'`';
}

$d = '';
foreach ($ds as $column) {
	$d = ($d == '') ? '`'.$column.'`' : $d.', `'.$column.'`';
}

$query = 'INSERT IGNORE INTO '.$dbd.'.'.$tbd.'('.$d.') SELECT '.$s.' FROM '.$dbs.'.'.$tbs;

$result = $mysqli->query($query);

if ($result) { 
	echo 'INSERTED: '.$mysqli->info;
	$result->free();
} else {
	echo 'ERROR: '.$mysqli->error."\n".$query;
}

if ($mysqli) $mysqli->close();
unset($mysqli);
?>