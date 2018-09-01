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

$card_id = filter_input(INPUT_GET, 'card_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'card_id', FILTER_VALIDATE_INT) ?? null;
$editCat_id = filter_input(INPUT_GET, 'editCat_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'editCat_id', FILTER_VALIDATE_INT) ?? null;
$c_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING) ?? "";
$answer = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_STRING) ?? "";


//login stuff
$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? NULL;
	
//signup form stuff
$suName = filter_input(INPUT_POST, 'suName', FILTER_SANITIZE_STRING) ?? NULL;
$suEmail = filter_input(INPUT_POST, 'suEmail', FILTER_SANITIZE_STRING) ?? NULL;
$suPassword = filter_input(INPUT_POST, 'suPW', FILTER_SANITIZE_STRING) ?? NULL;

//categorydropdowns
$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;
$createCat = filter_input(INPUT_POST, 'createCatDDL', FILTER_SANITIZE_STRING) ?? "";

// bool for buttons
$buttonUpdate = false;

switch($action) {
	
	default:
	include("homepage.php");
	break;
	
	//homepage.php
	case "Sign Up":
	$sql = addUser($db, $suName, $suEmail, $suPassword);
	include_once("loggedInHome.php");
	//var_dump($sql);
	break;
	
	//loggedInHome.php
	case "View Cards":
	$flashcards = getFlashcards($db, $category);
	//var_dump($category);
	include("loggedInHome.php");
	$category === $category;
	//var_dump($flashcards);
	break;
	
	case "Add Cards":
	include("createFlashcards.php");
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
	
	//on flashcard
	case "EditCard":
	$flashcards = getFlashcard($db, $c_id);
	foreach($flashcards as $flashcard) {
	}
	$buttonUpdate = true;
	//var_dump($c_id);
	include_once("createFlashcards.php");
	break;
	
	//createFlashcards.php
	//adding flashcards
	
	case "Submit & Add More":
	addFlashcard($db, $createCat, $question, $answer);
	include_once("createFlashcards.php");
	break;
	
	case "Submit & Complete":
	addFlashcard($db, $createCat, $question, $answer);
	$flashcards = getFlashcards($db, $createCat);
	include("loggedInHome.php");
	break;
	
	case "Update":
	$sql = updateFlashcard($db, $card_id, $question, $answer);
	//var_dump($sql);
	include("loggedInHome.php");
	//$message = "Flashcard updated.";
	break;
	
	case "Cancel":
	$flashcards = getFlashcards($db, $editCat_id);
	//var_dump($category);
	include("loggedInHome.php");
	//$category === $category;
	//var_dump($flashcards);
	break;
}






?>