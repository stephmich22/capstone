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
    <div class="container-fluid">
	<div class="row head">
		<div class="col-md-6 col-sm-12">
		<div id="header">
		<h1><a href="index.php"><u>FlashA</u>pp<img src="images/notes.png" id="logo"></a></h1>
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
		<div class="col-md-6 col-sm-12 login">
			  <div id="loginDiv">
			  <form action="index.php" method="post">
			  <input type="text" value="" placeholder="Email" class="form-control home login text" name="email">
			  <input type="text" value="" placeholder="Password" class="form-control home login text" name="password">
			  <input type="submit" name="action" value="Login" class="btn login">
			  </form> 
			  </div>  <!--loginDiv CLOSE -->
		</div>
	</div> 
		<div class="row middle">
		<div class="col-md-6 col-sm-12 middle">
			<div class="flashcardHome">
			<a class="card question">
			<h3>What is FlashApp?</h3>
			</br></br>
			<p>Tap to learn more!</p></a>
			<a class="card answer"></br></br>
			<p>FlashApp is this bangin new app made by some weirdo</p>
			</a>
			</div>
			<div class="flashcardHome">
			<h3>Why use FlashApp?</h3>
			<p>Tap to learn more!</p>
			</br></br>
				
			</div>
		</div>
		<div class="col-md-6 col-sm-12 middle">
			<h2 class="title signup">Sign Up <i class="fas fa-user-plus"></i></h2>
			<div id="signupDiv">
			<form action="index.php" method="post">
			<input type="text" name="suName" placeholder="Name"class="form-control home login text signup"></br>
			</br> <input type="text" name="suEmail" placeholder="Email"class="form-control home login text signup"></br>
			</br> <input type="text" name="suConEmail" placeholder="Confirm Email" class="form-control home login text signup"></br>
			</br> <input type="password" name="suPW" placeholder="Password" class="form-control home text signup"></br>
			</br><input type="password" name="suConPW" placeholder="Confirm Password" class="form-control home text signup confirm"></br>
			<input type="submit" name="action" value="Sign Up" class=" btn signup"></br>
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