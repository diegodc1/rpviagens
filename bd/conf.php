<?php
$db_name = 'rpviagens';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';


// Conectando com o BD
$query = $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);
