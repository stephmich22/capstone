<?php
$dsn = "mysql:host=localhost;dbname=phpspringclass2018";
$userName = "PHPClassSpring2018";
$pWord = "SE266";
try {//pdo expects 3 things, 1)what am i connecting to 2)username 3)password

	$db = new PDO($dsn, $userName, $pWord);
	
}catch (PDOException $e) {
	
	die("Cannot connect to the database");
}