<?php

/*if($_SESSION['username'] == NULL || !isset($_SESSION['username']))
{
	header('location: homepage.php');
}*/
require_once("db.php");
require_once("functions.php");

//TABLES & COLUMNS
/*
	categories
	cat_id, cat_name, user_id, date_created
	
	flashcards
	fCard_id, cat_id, question, answer
	
	users
	user_id, name, email, password

*/

$categories = "";
$cards = "";
$addCat = "";
$title = "";
$rightSide = "";

//creating category drop down list
$categories .= "<div id='buttonsDiv'>";
$categories .= "<form action='index.php' method='get'>";
$categories .= "<select name='categoryDDL' id='categoryDDL'>";
//onchange='if(this.options.selectedIndex>0) window.location.href = 'index.php?product='+this.options [this.options.selectedIndex].value'
$categories .= "<option value='hi'>Select A Category</option>";

$catOptions = getCats($db);

	foreach($catOptions as $catOption) {
		$categories .= "<option value='" . $catOption['cat_id'] . "'>" . $catOption['cat_name'] . "</option>";
	}
	

$categories .= "</select></br>"; //closing categoryDDL

$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;

$categories .= "<div id='justButtonsDiv'>";
$categories .= "<input type='submit' name='action' value='View Cards' class='button'>";
$categories .= "<input type='submit' name='action' value='Edit Cards' class='button'></div>";
//$categories .= "<input type='submit' name='action' value='Add Cards' class='button'></div>"; //closing justButtonsDiv
$categories .= "</div>"; //closing buttonsDiv



//flashcards display

global $flashcards;
//global $category;
var_dump($category);
echo($category);
$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;

if($category !== 'hi') { //if a category other than default is selected
	
	if($category !== NULL) {
		
		//$category === $category;
	$titleNames = getCatName($db, $category);
	
	foreach($titleNames as $titleName) {
		$title_name = $titleName['cat_name'];
	}
	
	$title .= "<h2>" . $title_name . "</h2>";
	$cards .= "<div id='cardDisplay'>";
	//$cards .= "<table>";
	
	
		foreach($flashcards as $flashcard) {
			$cards .= "<tr><td><div id='flashcardHome'><div class='qaHolder'>Question: <p>" . $flashcard['question'] . "</p></br></br>Tap to view Answer</div></div></td></tr>";
		}
	
	//$cards .= "</table>"; // table CLOSE
	$cards .= "</div>"; // tableDiv CLOSE
	
	
	}// $category !== NULL CLOSE
	else { //$category is NULL
	//echo "hi";
	$addCat .= "<div id='addCatDiv'>";
	$addCat .= "</br></br><form action='index.php' method='post'><h5>Add New Category: </h5><input type='text' value=''><input type='submit' name='action' class='button' value='Add Category'>";
	$addCat .= "</form></div>";
	
	//right side col (creating entirely new group of cards)
	$rightSide .= "<div id='addNewCardsDiv'>";
	$rightSide .= "</br></br><form action='index.php' method='post'><input type='submit' name='action' class='button' value='Add New Cards to New or Existing Category'>";
	$rightSide .= "</form></div>";
	}
	
}// $category !== 'default' CLOSE

else { // $category === default
	//echo "bye";
	$addCat .= "<div id='addCatDiv'>";
	$addCat .= "</br></br><form action='index.php' method='post'><h5>Add New Category: </h5><input type='text' value=''><input type='submit' name='action' class='button' value='Add Category'>";
	$addCat .= "</form></div>";
	
	$rightSide .= "<div id='addNewCardsDiv'>";
	$rightSide .= "</br></br><form action='index.php' method='post'><input type='submit' name='action' class='button' value='Add New Cards to New or Existing Category'>";
	$rightSide .= "</form></div>";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<!-- css stylesheet -->
	<link type="text/css" rel="stylesheet" href="style.css">

    <title>FlashApp</title>
  </head>
  <body>
    <div class="container-fluid"> <!-- must have a container in bootstrap -->
	<div class="row bg-white head">
		<div class="col-md-12 col-sm-6">
		<div id="header">
		<h1><a href="index.php">FlashApp <img src="images/notes.png" id="logo"></a></h1>
		
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Site Menu
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="createFlashcards.php">Create Flashcards</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="loggedInHome.php">Home</a>
			</div> <!-- dropdown-menu CLOSE -->
			</div> <!-- btn-group div CLOSE -->
			
		</div> <!-- header div CLOSE -->
		</div> <!-- col CLOSE -->
	</div> <!-- header div CLOSE -->
		<div class="row bg-white">
		
		<div class="col-md-8 col-sm-12">
		<h2>My Flashcards</h2></br>
		<div id="catDdlDiv">
		<?php
			
			echo $categories;
			echo $addCat;
		?>
		</div> <!-- catDdlDiv CLOSE -->
		<?php
			echo $title;
			echo $cards;
		?>
		</div> <!--col CLOSE -->
		<?php 
			
			echo $rightSide;
			if(!$rightSide === "")
			{
		?>
		<div class="col-md-4 col-sm-12">
		
		<?php 
		
			}
			else {
				?>
				<div class="col-12">
				<?php 
			}
		?>
		</div>
		</div> <!-- row CLOSE -->
		
		<div class="bg-white footer col-12">
				<p>FlashApp | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>