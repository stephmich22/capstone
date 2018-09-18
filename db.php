<?php

/*$dsn = "mysql:host=localhost;dbname=Capstone";
$userName = "PHPClassSpring2018";
$pWord = "SE266";

$dsn = "mysql:host=ict.neit.edu:5500;dbname=flashapp";
$userName = "stephanie";
$pWord = "neit2018";

try {//pdo expects 3 things, 1)what am i connecting to 2)username 3)password

	$db = new PDO($dsn, $userName, $pWord);
	
}catch (PDOException $e) {
	
	die("Cannot connect to the database");
}*/



if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'ict.neit.edu') {
        $config = array(
        'DB_DNS' => "mysql:host=localhost;port=5500;dbname=flashapp",
        'DB_USER' => "stephanie",
        'DB_PASSWORD' => "neit2018"
    );
    } else { //local
        $config = array(
            'DB_DNS' => "mysql:host=localhost;port=3306;dbname=Capstone;",
            'DB_USER' => "PHPClassSpring2018",
            'DB_PASSWORD' => "SE266"
        );
    
	}


 $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	

