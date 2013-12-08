<?php

/**
 * DB table fields Copier v.1.0
 * @autor: Alex Lifantyev <al@arte.kz>
 */

$db = array(
	'host' => 'localhost',
	'database' => '',
	'user' => '',
	'password' => ''
	);

$mysqli = mysqli_init();

if (!$mysqli) {
	die('Initialization of connection failed');
}

$res = true;
$res = $res && $mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 1');
$res = $res && $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

if (!$res) {
	die('Setting options failed');
}

$res = $mysqli->real_connect($db['host'], $db['user'], $db['password']);
if (!$res) {
    die('Database connection error ('.mysqli_connect_errno().'): '.mysqli_connect_error());
}

?>