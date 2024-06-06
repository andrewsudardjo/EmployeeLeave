<?php

$dsn = 'mysql:host=localhost;dbname=mydb';
$user = 'myapp';
$pass = '1234';

try{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Couldnt connect to database" . $e->getMessage());
}

?>
