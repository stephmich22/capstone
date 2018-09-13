<?php
if(!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == NULL){
	header('location: homepage.php');
}
if(!isset($_SESSION["category"])) {
	header('location: homepage.php');
}

$title = "<h2 class='title'>Delete Category</h2>";
global $category;
var_dump($_SESSION["category"]);

$categoryNames = getCatName($db, $category);
foreach($categoryNames as $categoryName) {
	$catName = $categoryName['cat_name'];
}

/*$deleteCat_ids = getCatId($db, $category);
foreach($deleteCat_ids as $deleteCat_id) {
	$catToDelete = $deleteCat_id["cat_id"];
}
var_dump($catToDelete . "hi");
$flashcardsToDelete = array();

$flashcards_ids = getFlashcards($db, $_SESSION["category"]);
foreach($flashcards_ids as $flashcard_id) {
	
	array_push($flashcardsToDelete, $flashcard_id["fCard_id"]);
}
var_dump($flashcardsToDelete);*/
$sure = "";

$sure .= "<div id='sureDiv'><h3>Are you sure you would like to delete the entire '" . $catName . "' category?</h3>";
$sure .= "<form action='index.php' method='post'><input type='hidden' name='catToDelete' value='" . $catName . "'><input type='submit' class='btn' name='action' value='Yes'>";
$sure .= "<input type='submit' class='btn' name='action' value='No'></form></div>";


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
				<form action='index.php' method='get'>
				<a class="dropdown-item" href="?action=Home">Home</a>
				<a class="dropdown-item" href="?action=Create">Create Flashcards</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="?action=LogOut">Log Out</a>
			</form>
			</div> <!-- dropdown-menu CLOSE -->
			</div> <!-- btn-group div CLOSE -->
			
		</div> <!-- header div CLOSE -->
		</div> <!-- col CLOSE -->
	</div> <!-- header row CLOSE -->
		<div class="row titleRow">
		<div class="col-md-12 col-sm-12">
		<div class="titleDiv">
		<?php
			echo $title;
		
		?>
		</div> <!-- titleDiv CLOSE -->
		</div> <!-- col CLOSE -->
		</div> <!-- titleRow CLOSE -->
		
		<div class="row middle">
		<?php
			echo $sure;
		
		?>
		<div class="col-md-12 col-sm-12 middle">
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
  </body>
</html>