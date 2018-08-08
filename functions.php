<?php

//All functions for application

//TABLES & COLUMNS
/*
	categories
	cat_id, cat_name, user_id, date_created
	
	flashcards
	fCard_id, cat_id, question, answer
	
	users
	user_id, name, email, password

*/


// CATEGORY SQL STATEMENTS ------------------------------------------------
//select categories
function getCats($db, $sessionUser_id) {
	try {
		$sql = $db->prepare("SELECT * FROM categories WHERE user_id=$sessionUser_id ORDER BY date_created DESC");
		$sql->execute();
		$results=$sql->fetch(PDO::FETCH_ASSOC);
		
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem retrieving categories.");
	}
}
//add new category ..
function addCategory($db, $catName, $sessionUser_id) {
	try {
		$sql = $db->prepare("INSERT INTO categories VALUES(NULL, '$catName', $sessionUser_id, NOW())");
		$sql->execute();
	} catch(PDOException $e) {
		die("There was an error adding category");
	}
}

//update existing category name
function updateCategoryName($db, $editCatName, $editCatName_id) {
	try {
		$sql = $db->prepare("UPDATE `categories` SET cat_name='$editCatName' WHERE cat_name='$editCatName_id'");
		$sql->execute();
	} catch(PDOException $e) {
		die("There was a problem updating category.");
	}
}

//delete category
//^ 2 steps, you must first delete flashcards with common category ID and THEN delete the category


//FLASHCARD SQL FUNCTIONS -------------------------------------------------
//select flashcards
function getFlashcards($db, $cat_id) {
	try {
		$sql = $db->prepare("SELECT * FROM flashcards WHERE cat_id=$cat_id");
		$sql->execute();
		$results=$sql->fetch(PDO::FETCH_ASSOC);
		
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem retrieving flashcards.");
	}
}
//add new flashcard
function addFlashcard($db, $catNameDDL, $question, $answer) {
	try {
		$sql = $db->prepare("SELECT cat_id FROM categories WHERE cat_name='$catNameDDL'");
		$sql->execute();
		$results=$sql->fetch(PDO::FETCH_ASSOC);
		
		foreach($results as $results) {
			$id = $result['cat_id'];
			var_dump($id);
		}
		
		$sql2 = db->prepare("INSERT INTO flashcards VALUES(null,$id,'$question','$answer')");
		$sql2->execute();
		return $sql2;
		
	} catch(PDOException $e) {
		die("There was a problem adding flashcard")
	}
}

//update existing flashcard


//delete flashcard


// AUTHENTICATION FUNCTIONS -----------------------------------------------

//check credentials



//ACCOUNT FUNCTIONS & SQL STATEMENTS --------------------------------------

//create new account

//edit account info




?>