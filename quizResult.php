<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<title>Match Quiz Results</title>
		<link  rel="stylesheet" href="css/matchResultStyle.css">
	</head>
	<body>
		
		<div id="resultWrapper" class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center">End of Quiz1</h1>
				<?php
				$total = 3;
				$score = $_GET["var1"];
				if ($score ==  $total)
				{
					echo "<h2 class='text-center'>Congratulations!</h2>";
				}
				else
				{
					echo "<h2 class='text-center'>Please take sometime to practice this section again.</h2>";
				}
	
				echo "<h2 class='text-center'>Your score was " . $score . " out of " . $total . ".</h2>";
				?>
				<br>
				<input type="submit" id="submit" onClick="launch();" value="Save and Return to Main Menu">
				</div>
			</div>
			<script>
				function launch(){
					window.location = "main.php";
				}
			</script>
		</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>