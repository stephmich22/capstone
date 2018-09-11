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
//function getCats($db, $sessionUser_id) {
function getCats($db, $sessionID) {
	try {
		//$sql = $db->prepare("SELECT * FROM categories WHERE user_id=$sessionUser_id ORDER BY date_created DESC");
		$sql = $db->prepare("SELECT * FROM categories WHERE user_id=$sessionID ORDER BY date_created DESC");
		$sql->execute();
		$results=$sql->fetchAll(PDO::FETCH_ASSOC);
		
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem retrieving categories.");
	}
}
//add new category 
function addCategory($db, $catName, $sessionUser_id) {
	try {
		$sql = $db->prepare("INSERT INTO categories VALUES(NULL, '$catName', $sessionUser_id, NOW())");
		$sql->execute();
		
		return $sql;
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

function getCatName($db, $category) {
	try {
		$sql = $db->prepare("SELECT cat_name FROM categories WHERE cat_id = '$category'");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		return $results;
	} catch(PDOException $e) {
		die("There was a problem getting category name.");
	}
}
function getCatId($db, $c_id){
	try {
		$sql = $db->prepare("SELECT cat_id FROM flashcards WHERE fCard_id=$c_id");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		return $results;
		
	} catch(PDOException $e) {
		die("Nope.");
	}
}

//delete category
function deleteCategory($db, $deleteCat_name, $sessionID) {
	try {
	
	$sql = $db->prepare("SELECT cat_id FROM categories WHERE cat_name='$deleteCat_name'");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($results as $result) {
		$cat_id = $result['cat_id'];
	}
	
	
	$sql2 = $db->prepare("DELETE FROM flashcards WHERE cat_id=$cat_id");
	$sql2->execute();
	
	$sql3 = $db->prepare("DELETE FROM categories WHERE cat_id=$cat_id");
	$sql3->execute();
	
	} catch(PDOException $e) {
		die("There was a problem deleting category.");
	}
	
	
}
function deleteCard($db, $id) {
	try {
		
	$sql = $db->prepare("DELETE FROM flashcards WHERE fCard_id=$id");
	$sql->execute();
	
	return $sql;
	
	} catch(PDOException $e) {
		die("There was a problem deleting this card.");
	}
	
}
//^ 2 steps, you must first delete flashcards with common category ID and THEN delete the category


//FLASHCARD SQL FUNCTIONS -------------------------------------------------
//select flashcards
function getFlashcards($db, $cat_id) {
	try {
		$sql = $db->prepare("SELECT * FROM flashcards WHERE cat_id = '$cat_id'");
		//$sql->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem retrieving flashcards.");
	}
}
//get single flashcard (to edit or delete)
function getFlashcard($db, $id) {
	try {
		$sql = $db->prepare("SELECT * FROM flashcards WHERE fCard_id='$id'");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem retrieving flashcard");
	}
}
//add new flashcard
function addFlashcard($db, $catNameDDL, $question, $answer) {
		try {
			$sql = $db->prepare("INSERT INTO flashcards VALUES(NULL, '$catNameDDL','$question', '$answer')");
			$sql->execute();
			
			//return $sql;
			
		} catch(PDOException $e) {
			die("There was a problem adding flashcard.");
		}
}

//update existing flashcard
function updateFlashcard($db, $fCard_id, $question, $answer) {
		try {
			$sql = $db->prepare("UPDATE `flashcards` SET question = '$question' answer = '$answer' WHERE fCard_id='$fCard_id'");
			$sql->execute();
			
			return $sql;
			
		} catch(PDOException $e) {
			die("There was a problem updating flashcard.");
		}
}

//delete flashcard


// AUTHENTICATION FUNCTIONS -----------------------------------------------

//check credentials
function login($db, $email, $password) {
	try {
		$sql = $db->prepare("SELECT * FROM users where email = '$email' and password = '$password'");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		return $results;
		
	} catch(PDOException $e) {
		die("There was a problem logging in.");
	}
}

function endSession() {
	session_destroy();
    session_start();
}



//ACCOUNT FUNCTIONS & SQL STATEMENTS --------------------------------------

//create new account
function addUser($db, $name, $email, $password) {
	try {
		$sql = $db->prepare("INSERT INTO users VALUES (NULL, '$name', '$email', '$password')");
		$sql->execute();
		
		
		
	} catch(PDOException $e) {
		die("There was a problem creating user account");
	}
	
	return $sql;
	
}
function checkForEmail($db, $email) {
	try {
		$sql = $db->prepare("SELECT * FROM users WHERE email='$email'");
		$sql->execute();
		$results = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($results) > 0) {
			$exists = true;
		} else {
			$exists = false;
		}
		return $exists;
	} catch(PDOException $e) {
		die("There was a problem checking email");
	}
}

//edit account info

//save for review
function saveForReview($db, $sessionCard_id, $sessionUser_id) {
	try {
		
	} catch(PDOException $e) {
		die("There was a problem addin");
	}
}




?>