<?php
//session_start();

//TABLES & COLUMNS
/*
	categories
	cat_id, cat_name, user_id, date_created
	
	flashcards
	fCard_id, cat_id, question, answer
	
	users
	user_id, name, email, password

*/
require_once("db.php");
require_once("functions.php");

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
	
//login stuff
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? NULL;
	
//signup form stuff
$suName = filter_input(INPUT_POST, 'suName', FILTER_SANITIZE_STRING) ?? NULL;
$suEmail = filter_input(INPUT_POST, 'suEmail', FILTER_SANITIZE_STRING) ?? NULL;
$suPassword = filter_input(INPUT_POST, 'suPW', FILTER_SANITIZE_STRING) ?? NULL;

//categorydropdown
$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;

//catID
//$catID = filter_input(INPUT_GET, 'catID', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'catID', FILTER_VALIDATE_INT) ?? null;

switch($action) {
	
	default:
	include("homepage.php");
	break;
	
	//homepage.php
	case "Sign Up":
	$sql = addUser($db, $suName, $suEmail, $suPassword);
	include_once("loggedInHome.php");
	var_dump($sql);
	break;
	
	//loggedInHome.php
	case "View Cards":
	$flashcards = getFlashcards($db, $category);
	var_dump($category);
	include("loggedInHome.php");
	$category === $category;
	var_dump($flashcards);
	break;
	
	case "Add Category":
	addCategory($db, $catName, $sessionUser_id);
	include("loggedInHome.php");
	break;
	
	case "Login":
	$results = login($db, $email, $password);
	if(count($results) == 1) {
		$SESSION['username'] = $email;
		foreach($results as $result) {
			$user_id = $result['user_id'];
			$user_name = $result['name'];
		}
		$SESSION['customer_id'] = $user_id;
		$SESSION['user_name'] = $user_name;
	include_once("loggedInHome.php");
	}
	else {
		echo "Sorry, invalid email or password";
	}
	break;
	
	case "Answer":
	include_once("index.php");
	break;
	
	//createFlashcards.php
	case "Submit & Add More":
	//function that adds flashcard to category
	include_once("createFlashcards.php");
	break;
	
	case "Submit & Complete":
	//function that adds flashcard to category
	include("loggedInHome.php");
	break;
}






?>