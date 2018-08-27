<?php
	//include("loggedInHome.php");
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

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid"> <!-- must have a container in bootstrap -->
	<div class="row bg-white head">
		<div class="col-md-12 col-sm-12">
		<div id="header">
		<h1><a href="index.php">FlashApp <img src="images/notes.png" id="logo"></a></h1>
		
		<!-- three-line drop down menu symbol
		<a href="#menu">&#9776;</a> -->
		
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Site Menu
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="createFlashcards.php">Create Flashcards</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="loggedInHome.php">Home</a>
			</div> <!-- dropdown-menu CLOSE -->
			</div> <!--  btn-group div CLOSE -->
		</div> <!-- headerDiv CLOSE -->
		</div>
		
	<!--	<div class="bg-danger col-md-6 col-sm-12">
		</div> -->
	</div> <!-- header div CLOSE -->
	
		<div class="row bg-white"> <!-- we have 12 columns to work with -->
		<div class="bg-white col-md-12 col-sm-12">
		</br>
		<div id="selectAndAddNewDiv">
		<div id="selectCreateDiv">
		<select class="createSelect">
		<option>Select Category</option>
		</select></div> <!-- selectCreateDiv CLOSE --> Or <div id="addNewCatCreateDiv"><h5>Add New Category: </h5><input type="text" value=''><input type='submit' name='action' class='button' value='Add Category'></div> <!-- addNewCatCreateDiv CLOSE -->
		</br>
		</div> <!-- selectAndAddNewDiv CLOSE -->
		<div id="flashcardCreate">
		
		<div id="qaDiv">
		<form action="index.php" method="post">
		<h3>Question:</h3></br>
		<textarea autofocus placeholder="Question"></textarea></br>
		<h3>Answer:</h3></br>
		<textarea placeholder="Answer"></textarea></br>
		<input type="submit" name="action" value="Submit & Add More" class="button create">
		<input type="submit" name="action" value="Submit & Complete" class="button create">
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
  </body>
</html>