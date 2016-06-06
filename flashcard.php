<?php
	/**
   * @edited by Oleksandr, Axum, Ramona
   * @version 2.0
   * @filename flashcard.php
   * this file is used to run flash cards page based on section
   * that have been chosen
   */
  //Create session
  require 'session.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
      
	  	<!-- Bootstrap -->
	  	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<title>Aviation</title>
		<link rel="stylesheet" type="text/css" href="css/flashcard.css">
	</head>

	<body>
		<div class='container'>
			<div class = "masthead">
				<ul class="nav nav-pills pull-left">
					<li><a href="main.php"><img src="images/menu.png" alt="menu" title="Home page"></a></li>
				</ul>
			</div>

			<div id="content">
				<div class="jumbotron" id="card1">
					<div class="word"></div>
						
					<br>

					<section>					
						<img class="imageBorder" alt="image of word">					
					</section>

					<br>
					
					<div class="desc">
						
					</div>

					<br>

					<div>
						<img id="prev" src="images/left.png" alt="back button" title="previous">
						<img id="audioIcon" src="images/audioicon.png" alt="audio icon to hear word" title="listen">
						<audio id="audioPlay"></audio>
						<img id="next" src="images/right.png" alt="forward button" title="next">
					</div>
				</div>
			</div>

			<script src="http://code.jquery.com/jquery.js"></script>
			<?php
				require 'sectionGrabber.php';
			?>
			//this script is used to switch between the cards using code from sectionGrabber.php
			<script>
				$(document).ready(function() {
					next();
					$("#prev").click(function () {
						prev();
					});

					$("#next").click(function () {
						next();
					});

					$("#audioIcon").click(function() {
						document.getElementById("audioPlay").load();
						document.getElementById("audioPlay").play();	
					});

					function grid(){
						next();
					}
				});
			</script>
			<footer class="container-fluid">
			  <hr>
			  <p>
			  	<a href="admin/index.php">Administration</a>
			  </p>
			</footer>

			<!--
	    	<footer>
	    		<hr>
	      		<a href="admin/index.php">Administration</a>
	    	</footer> -->
    	</div>

    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
//Flush buffer
 ob_flush();
?>