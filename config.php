<?php

$db = array(
	'host' => 'localhost',
	'database' => '',
	'user' => 'usersource',
	'password' => 'EwRXwfvrhtA3BnML'
	);

$mysqli = mysqli_init();

if (!$mysqli) {
	die('Initialization of connection failed');
}

$res = true;
$res = $res && $mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0');
$res = $res && $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

if (!$res) {
	die('Setting options failed');
}

$res = $mysqli->real_connect($db['host'], $db['user'], $db['password']);
if (!$res) {
    die('Database connection error ('.mysqli_connect_errno().'): '.mysqli_connect_error());
}

?>