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
    <div class="container-fluid">
	<div class="row bg-white head">
		<div class="col-md-6 col-sm-12">
		<div id="header">
		<h1><a href="index.php">FlashApp <img src="images/notes.png" id="logo"></a></h1>
		<!--
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Site Menu
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="createFlashcards.php">Create Flashcards</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="homepage.php">Home</a>
			</div> <!-- dropdown-menu CLOSE -->
		<!--	</div>  btn-group div CLOSE -->
			
		</div> <!-- header div CLOSE -->
		</div> <!-- col CLOSE -->
		<div class="bg-white col-md-6 col-sm-12 login">
			  <div id="loginDiv">
			  <form action="index.php" method="post">
			  <input type="text" value="" placeholder="Email" class="textBox" name="email">
			  <input type="text" value="" placeholder="Password" class="textBox" name="password">
			  <input type="submit" name="action" value="Login" class="button">
			  </form> 
			  </div>  <!--loginDiv CLOSE -->
		</div>
	</div> 
		<div class="row bg-white"> <!-- we have 12 columns to work with -->
		<div class="bg-white col-md-6 col-sm-12">
			<div id="flashcardHome">
			<h3>What is FlashApp?</h3>
			<p>Tap to learn more!</p>
			<!-- <div id="homeAnswerBtn" class="bg-primary">
			<input type="submit" name="action" class="button" value="Answer">
			</div> <!-- homeAnswerBtn CLOSE -->
			</br>Text after flipping card:</br>
				
				FlashApp is a study app that blah blah blah..
			</div>
			<div id="flashcardHome">
			<h3>Why use FlashApp?</h3>
			<p>Tap to learn more!</p>
			<!-- <div id="homeAnswerBtn" class="bg-primary">
			<input type="submit" name="action" class="button" value="Answer">
			</div> <!-- homeAnswerBtn CLOSE -->
			</br>Text after flipping card:
				blah, blah, blah
				
			</div>
		</div>
		<div class="bg-white col-md-6 col-sm-12">
			<h2>Sign Up</h2>
			<div id="signupDiv">
			<form action="index.php" method="post">
			Name:</br> <input type="text" name="suName"></br>
			Email:</br> <input type="text" name="suEmail"></br>
			Confirm Email:</br> <input type="text" name="suConEmail"></br>
			Password:</br> <input type="password" name="suPW"></br>
			Confirm Password: </br><input type="password" name="suConPW"></br>
			<input type="submit" name="action" value="Sign Up" class=" button"></br>
			</form>
			</div> <!-- signupDiv CLOSE -->
		</div>
		</div>
			<div class="footer col-12 bg-white">
				<p>FlashApp | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
		
	
	</div> <!-- container CLOSE -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>