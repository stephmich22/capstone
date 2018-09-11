<?php
if(!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == NULL){
	header('location: homepage.php');
}

include_once("index.php");
	//include("loggedInHome.php");
require_once("db.php");
require_once("functions.php");
global $buttonUpdate;
global $sessionUser_id;
global $editCat_id;

	$addNewcat = "<div id='addNewCatCreateDiv'><input type='text' value='' class='form-control' placeholder='Add New Category'><input type='submit' name='action' class='btn' value='Add Category'></br></div>";

	$selectForCreate = "";
	$selectForCreate .= "<div id='selectAndAddNewDiv'>";
	$selectForCreate .= "<div id='selectCreateDiv'>";
	$selectForCreate .= "<select name='createCatDDL' class='form-control'><option>Select Category</option>";
	
	$catOptions = getCats($db,$sessionUser_id);

	foreach($catOptions as $catOption) {
		$selectForCreate .= "<option value='" . $catOption['cat_id'] . "'>" . $catOption['cat_name'] . "</option>";
	}
	
	$selectForCreate .= "</select></div>Or.."; //selectCreateDiv CLOSE
	/*$selectForCreate .= "<div id='addNewCatCreateDiv'><h5>Add New Category</h5><input type='text' value=''><input type='submit' name='action' class='button' value='Add Category'></div>"; //addNewCatCreateDiv CLOSE*/
	$selectForCreate .= "</div>"; //selectAndAddNewDiv CLOSE
	
	//var_dump($buttonUpdate);
	
	if($buttonUpdate == true) {
		
		var_dump($editCat_id);
		var_dump($c_id);
		$heading = "<h2>Edit Flashcard</h2>";
		$createButtons = "<input type='submit' name='action' value='Update' class='btn'><input type='submit' name='action' value='Delete' class='btn'><input type='submit' name='action' value='Cancel' class='btn'>";
	}
	else {
		
		$heading = "<h2>New Flashcard</h2>";
		$createButtons = "<input type='submit' name='action' value='Submit & Add More' class='btn'><input type='submit' name='action' value='Submit & Complete' class='btn'>";
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

	<!-- jquery -->
	<script src="jquery-3.3.1.min.js"></script>
	
    <title>FlashApp</title>
  </head>
  <body>
    <div class="container-fluid"> <!-- must have a container in bootstrap -->
	<div class="row bg-white head">
		<div class="col-md-12 col-sm-12">
		<div id="header">
		<form action='index.php' method='get'>
		<h1><a href="?action=flashApp"><u>FlashA</u>pp<img src="images/notes.png" id="logo"></a></h1>
		</form>
		<!-- three-line drop down menu symbol
		<a href="#menu">&#9776;</a> -->
		
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
		</div> <!-- headerDiv CLOSE -->
		</div>
		
	<!--	<div class="bg-danger col-md-6 col-sm-12">
		</div> -->
	</div> <!-- header div CLOSE -->
	
		<div class="row middle"> <!-- we have 12 columns to work with -->
		<div class="col-md-12 col-sm-12">
		</br>
		<form action='index.php' method='post'>
		<div id="flashcardCreate">
		<?php
		if(!isset($flashcard)) {
			echo $heading;
			echo $selectForCreate;
			echo "</br>";
			echo $addNewcat;
			
		}
		
		?>
		<div id="qaDiv">
		<?php
		if($buttonUpdate == true) {
			echo "<h2>Question</h2>";
		}
		?>
		</br>
		<textarea placeholder="Question" name="question" value=""><?php if(isset($flashcard['question'])){
			echo $flashcard['question'];
			} ?></textarea></br>
		<?php
		if($buttonUpdate == true) {
			echo "<h2>Answer</h2>";
		}
		?>
		</br>
		<textarea placeholder="Answer" name="answer" value=""><?php if(isset($flashcard['answer'])) {
			echo $flashcard['answer'];
		}			?></textarea></br>
		
		<?php echo $createButtons;  ?>
		<!-- <input type="submit" name="action" value="Submit & Add More" class="button">
		<input type="submit" name="action" value="Submit & Complete" class="button"> -->
		</form>
		</div> <!-- qaDiv CLOSE -->
		</div> <!-- flashcardCreate CLOSE -->
		</div> <!-- col CLOSE -->
		</div> <!-- row CLOSE -->
			<div class="footer col-12 bg-white">
				<p>FlashApp | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
		
	
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<script type="text/javascript">
	
	
	
	
	</script> <!-- javascript script tag CLOSE -->
  </body>
</html>