<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$dsn = 'mysql:dbname=ghumgham;host=localhost';
$user = 'root';
$password = 'mysql';



try
{
	global $pdo;
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}


?>