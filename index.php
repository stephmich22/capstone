<?php
session_start();

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
//update card id
$editFCard_id = filter_input(INPUT_GET, 'editFCard_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'editFCard_id', FILTER_VALIDATE_INT) ?? null;
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
$suConEmail = filter_input(INPUT_POST, 'suConEmail', FILTER_SANITIZE_STRING) ?? NULL;
$suPassword = filter_input(INPUT_POST, 'suPW', FILTER_SANITIZE_STRING) ?? NULL;
$suConPassword = filter_input(INPUT_POST, 'suConPW', FILTER_SANITIZE_STRING) ?? NULL;

//categorydropdowns
$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;
$createCat = filter_input(INPUT_POST, 'createCatDDL', FILTER_SANITIZE_STRING) ?? "";
//cattext
$catNameText = filter_input(INPUT_POST, 'catNameText', FILTER_SANITIZE_STRING) ?? NULL;

//sessions

if(isset($_SESSION["customer_id"])) {
	$sessionUser_id = $_SESSION["customer_id"];
}

// bool for buttons
$buttonUpdate = false;
$buttonEditCat = false;

//add/edit cat button
$button = "Add Category";

//errormessages
$errorMessage = "";
$error = false;
$errorName = false;
$errorEmail = false;
$errorConEmail = false;
$errorPassword = false;
$errorConPassword = false;
$errorMatchEmail = false;
$errorMatchPassword = false;
$errorEmailExists = false;
$errorAddCat = false;
$blankQ = false;
$blankA = false;
$fieldError = false;
$invalidEmail = false;
$noMoreCards = false;

//checking for cards
$noFlashcards = false;
//checking for cat
$noCatSelected = false;
$noCatError = false;
$category_name = false;


//delete stuff
$deleteCat_name =  filter_input(INPUT_GET, 'catToDelete', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'catToDelete', FILTER_SANITIZE_STRING) ?? NULL;
	
//carrying over id to createpage
$hiddenCatName =  filter_input(INPUT_GET, 'hiddenCatName', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'hiddenCatName', FILTER_SANITIZE_STRING) ?? NULL;
	
//editing category
$editCatText = filter_input(INPUT_GET, 'catNameEditText', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'catNameEditText', FILTER_SANITIZE_STRING) ?? NULL;
$editName_id = filter_input(INPUT_GET, 'editName_id', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'editName_id', FILTER_SANITIZE_STRING) ?? NULL;

switch($action) {
	
	default:
	include("homepage.php");
	break;
	
	case "flashApp":
	if(isset($_SESSION["customer_id"])) {
		include("loggedInHome.php");
	}
	else {
		include("homepage.php");
	}
	break;
	
	//homepage.php
	case "Sign Up":
	if(empty($suName) || ctype_space($suName)) {
		$errorName = true;
		$error = true;
		//$errorMessage .= "Please enter a name </br>";
	}
	if(empty($suEmail) || ctype_space($suEmail)) {
		$errorEmail = true;
		$error = true;
		//$errorMessage .= "Please enter an email </br>";
	}
	if(empty($suConEmail) || ctype_space($suConEmail)) {
		$errorConEmail = true;
		$error = true;
		//$errorMessage .= "Please confirm you email address </br>";
	}
	if(empty($suPassword) || ctype_space($suPassword)) {
		$errorPassword = true;
		$error = true;
		//$errorMessage .= "Please choose your password </br>";
	}
	if(empty($suConPassword) || ctype_space($suConPassword)) {
		$errorConPassword = true;
		$error = true;
		//$errorMessage .= "Please confirm your password </br>";
	}
	if($suEmail !== $suConEmail) {
		$errorMatchEmail = true;
		$error = true;
	}
	if($suPassword !== $suConPassword) {
		$errorMatchPassword= true; 
		$error = true;
	}
	if(filter_var($suEmail, FILTER_VALIDATE_EMAIL)){ 
		$invalidEmail = false;
	}else{ 
		$invalidEmail = true;
		$error = true;
	}
		if($error == false){
			$emailCheck = checkForEmail($db, $suEmail);
			if($emailCheck == false){
			$sql = addUser($db, $suName, $suEmail, $suPassword);
		$results = login($db, $suEmail, $suPassword);
		foreach($results as $result) {
			$user_id = $result['user_id'];
			$user_name = $result['name'];
		}
		$_SESSION["customer_id"] = $user_id;
		$_SESSION["user_name"] = $user_name;
		include_once("loggedInHome.php");
			}
			else {
				$errorEmailExists = true;
				include("homepage.php");
			}
	}
	else {
		include("homepage.php");
	}
	break;
	
	//loggedInHome.php
	case "View Cards":
	if($category == 'hi') {
		$noCatSelected = true;
		$noCatError = true;
	}
	else {
	$flashcards = getFlashcards($db, $category);
	if(count($flashcards) < 1) {
		$noFlashcards = true;	
	}}
	include("loggedInHome.php");
	//var_dump($flashcards);
	break;
	
	case "Add Cards":
	if($category == 'hi') {
		$noCatSelected = true;
		$noCatError = true;
		include("loggedInHome.php");
	}
	else {
	$_SESSION["category"] = $category;
	//var_dump($_SESSION["category"]);
	include("createFlashcards.php");
	}
	break;
	
	case "Edit Category Name":
	if($category == 'hi') {
		$noCatSelected = true;
		$noCatError = true;
		include("loggedInHome.php");
	} else {
		$category_name = true;
	include("loggedInHome.php");
	}
	//var_dump($category);
	break;
	
	case "Update Category":
	$hi = updateCategoryName($db, $editCatText, $editName_id);
	include("loggedInHome.php");
	//var_dump($hi);
	break;
	
	//error check for blank field
	case "Add Category":
	if(empty($catNameText) || ctype_space($catNameText))
	{
		$errorAddCat = true;
	}
	if($errorAddCat == false) {
	$hey = addCategory($db, $catNameText, $sessionUser_id);
	}
	include("loggedInHome.php");
	break;
	
	case "Login":
	$results = login($db, $email, $password);
	if(count($results) == 1) {
		foreach($results as $result) {
			$user_id = $result['user_id'];
			$user_name = $result['name'];
		}
		$_SESSION["customer_id"] = $user_id;
		$_SESSION["user_name"] = $user_name;
	include("loggedInHome.php");
	}
	else {
		$errorLogin = "Sorry, invalid login credentials.";
		include("homepage.php");
		
	}
	//var_dump($_SESSION["user_name"]);
	break;
	
	//dropdown list
	case "Create":
	include_once("createFlashcards.php");
	break;
	
	case "Home":
	include("loggedInHome.php");
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
	if(empty($question) || ctype_space($question)) {
		$blankQ = true;
		$fieldError= true;
	}
	if(empty($answer) || ctype_space($answer)) {
		$blankA = true;
		$fieldError= true;
	}
	if($fieldError == false) {
	addFlashcard($db, $_SESSION["category"], $question, $answer);
	$_POST['question'] = "";
	$_POST['answer'] = "";
	}
	include_once("createFlashcards.php");
	break;
	
	case "Submit & Complete":
	if(empty($question) || ctype_space($question)) {
		$blankQ = true;
		$fieldError= true;
	}
	if(empty($answer) || ctype_space($answer)) {
		$blankA = true;
		$fieldError= true;
	}
	if($fieldError == false) {
	addFlashcard($db, $_SESSION["category"], $question, $answer);
	include_once("loggedInHome.php");
	}
	else {
		include("createFlashcards.php");
	}
	break;
	
	case "Update":
	updateFlashcard($db, $editFCard_id, $question, $answer);
	$flashcards = getFlashcards($db, $editCat_id);
	include("loggedInHome.php");
	//$message = "Flashcard updated.";
	break;
	
	case "Cancel":
	if(isset($editCat_id)) {
	$flashcards = getFlashcards($db, $editCat_id);
	}
	//var_dump($category);
	include("loggedInHome.php");
	//$category === $category;
	//var_dump($editCat_id);
	//var_dump($flashcards);
	break;
	
	//delete
	case "Delete Category":
	if($category == 'hi') {
		$noCatSelected = true;
		$noCatError = true;
		include("loggedInHome.php");
	}
	else {
	$_SESSION["category"] = $category;
	//var_dump($_SESSION["category"]);
	include("deleteCat.php");
	}
	break;
	
	case "Yes":
	$help = deleteCategory($db, $_SESSION["category"], $_SESSION["customer_id"]);
	//var_dump($help);
	include("loggedInHome.php");
	break;
	
	case "No":
	include("loggedInHome.php");
	break;
	
	//delete card 
	case "Delete":
	deleteCard($db, $editFCard_id);
	$flashcards = getFlashcards($db, $editCat_id);
	if(count($flashcards) < 1) {
		$noFlashcards = true;
	}
	include("loggedInHome.php");
	break;
	
	//no cards in category addd
	case "Add Cards to Category":
	$categoryAdd_id = getCatIdFromName($db, $hiddenCatName, $_SESSION["customer_id"]);
	$_SESSION["category"] = $categoryAdd_id;
	//var_dump ($_SESSION["category"]);
	include("createFlashcards.php");
	break;
	
	case "LogOut":
	endSession();
	include("homepage.php");
	break;
}






?>