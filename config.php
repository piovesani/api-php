<?php

$host = 'localhost';
$dbName = 'devsnotes';
$user = 'root';
$password = '';

$pdo = new PDO("mysql:dbname=$dbName;host=$host", $user, $password);

$array = [
    'error' => '',
    'result' => []
];

?>