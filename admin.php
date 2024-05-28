<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=mydb';
$username = 'myapp';
$password = '1234';

try{

	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} 

?>


