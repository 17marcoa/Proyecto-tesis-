<?php

$hostname = 'localhost';
$username = 'root';
$password = '27866';
$db = 'db_medico';
$port = '3307';

$mysql = new mysqli(
    $hostname,
    $username,
    $password,
    $db,
    $port
);

if ($mysql->connect_error) {
    die('Fallo la conexión error: ' . $mysql->connect_error);
} else {
    if (!isset($_SESSION)) :
        session_start();
    endif;
}
