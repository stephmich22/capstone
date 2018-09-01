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
//$title = "";
$addNewCards = "";

//creating category drop down list
$categories .= "<div id='buttonsDiv'>";
$categories .= "<form action='index.php' method='get'>";
$categories .= "<select name='categoryDDL' id='categoryDDL' class='form-control home'>";
$categories .= "<option value='hi'>Select A Category</option>";

$catOptions = getCats($db);

	foreach($catOptions as $catOption) {
		$categories .= "<option value='" . $catOption['cat_id'] . "'>" . $catOption['cat_name'] . "</option>";
	}
	

$categories .= "</select>"; //closing categoryDDL

$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;

//$categories .= "<div id='justButtonsDiv'>";
$categories .= "<input type='submit' name='action' value='View Cards' class='btn'>";
$categories .= "<input type='submit' name='action' value='Add Cards' class='btn'>";
$categories .= "<input type='submit' name='action' value='Delete Category' class='btn'>";//</div>";
$categories .= "</div></form>"; //closing buttonsDiv



//flashcards display
global $flashcards;
//global $category;
//var_dump($category);
//echo($category);
$category = filter_input(INPUT_GET, 'categoryDDL', FILTER_SANITIZE_STRING) ?? NULL;

if($category !== 'hi' || isset($editCat_id)) { //if a category other than default is selected
	
	if($category !== NULL || isset($editCat_id)) {
		
		//$category === $category;
	$titleNames = getCatName($db, $category);
	
	if(isset($editCat_id)) {
		$titleNames = getCatName($db, $editCat_id);
	}
	
	foreach($titleNames as $titleName) {
		$title_name = $titleName['cat_name'];
	}
	
	$title = "<h2 class='title'>" . $title_name . "</h2>";
	$cards .= "<div id='cardDisplay'>";
	
	
		foreach($flashcards as $flashcard) {
			//question
			$cards .= "<div class='flashcardHome'><a class='card question'>Question: <p>" . $flashcard['question'] . "</p></br></br>Tap card to view Answer</br><input type='hidden' name='c_id' value='" . $flashcard['cat_id'] . "'></a>";
			//answer
			$cards .= "<a class='card answer'>Answer: <p>" . $flashcard['answer'] . "</p></br></br>Tap for question<input type='hidden' name='c_id' value='" . $flashcard['cat_id'] . "'></a></div><a class='editCard' href='?id=" . $flashcard['fCard_id'] . "&action=EditCard'>Edit Card</a>";
		}
	
	$cards .= "</div>"; // tableDiv CLOSE
	
	
	}// $category !== NULL CLOSE
	else { //$category is NULL
	//echo "hi";
	$addCat .= "<div id='addCatDiv'>";
	$addCat .= "</br></br><form action='index.php' method='post'><input type='text' value='' placeholder='Add New Category' class='form-control home'><input type='submit' name='action' class='btn' value='Add Category'>";
	$addCat .= "</form></div>";
	
	}
	
}// $category !== 'default' CLOSE

else { // $category === default
	//echo "bye";
	$addCat .= "<div id='addCatDiv'>";
	$addCat .= "</br><form action='index.php' method='post'><input type='text' value='' placeholder='Add New Category'><input type='submit' name='action' class='btn' value='Add Category'>";
	$addCat .= "</form></div>";
	
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
	<!-- css stylesheet -->
	<link type="text/css" rel="stylesheet" href="style.css">

    <title>FlashApp</title>
  </head>
  <body>
    <div class="container-fluid"> <!-- must have a container in bootstrap -->
	<div class="row bg-white head">
		<div class="col-md-12 col-sm-12">
		<div id="header">
		<h1><a href="index.php"><u>FlashA</u>pp<img src="images/notes.png" id="logo"></a></h1>
		
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Site Menu
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="loggedInHome.php">My Flashcards</a>
				<a class="dropdown-item" href="createFlashcards.php">Create Flashcards</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="homepage.php">Log Out</a>
			</div> <!-- dropdown-menu CLOSE -->
			</div> <!-- btn-group div CLOSE -->
			
		</div> <!-- header div CLOSE -->
		</div> <!-- col CLOSE -->
	</div> <!-- header row CLOSE -->
		<div class="row middle">
		
		<div class="col-md-12 col-sm-12 middle">
		
		<?php
		if(isset($titleNames)){
			echo $title;
		} else {
			echo "<h2 class='title'><u>M</u>y<u>Flashcards</u></h2>";
		}
		?>
		<!-- <h2><u>M</u>y <u>Flashcards</u></h2></br> -->
		<div id="catDdlDiv">
		<?php
			
			echo $categories;
			echo $addCat;
		?>
		</div> <!-- catDdlDiv CLOSE -->
		<?php
			//echo $addNewCards;
			echo $cards;
			
		?>
		</div> <!--col CLOSE -->
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
	
	<script type="text/javascript">
	
	var q = document.querySelectorAll(".flashcardHome");
	
	q.forEach(function(el) {
		let qa = el.querySelectorAll(".card");
		//let ec = el.querySelectorAll(".editCard");
		console.log(qa);
		qa.forEach(function(el) {
			el.addEventListener("click", function(a) {
				switch(el.classList[1])
				{
					case "question":
					qa[0].style.display="none";
					qa[1].style.display="block";
					
					
					break;
					
					default:
					qa[0].style.display="block";
					qa[1].style.display="none";
					break;
				}
			});
		});
	});
	
	
	</script> <!-- javascript script tag CLOSE -->
  </body>
</html>