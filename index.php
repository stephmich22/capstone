<?php

require_once("db.php");
require_once("functions.php");

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;


switch($action) {
	
	default:
	include("homepage.php");
	break;
	
	
}






?>