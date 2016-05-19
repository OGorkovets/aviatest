<?php
//Start a session
session_start();
// Start the buffer
ob_start();

    /*if(empty($_SESSION["myusername"])){
	    session_unset();
	    header("location:index.html");
    }*/
    if(empty($_SESSION["loggedin"])){
      session_unset();
      header("location:index.html");
    }
?>
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

	  <title>Match Quiz</title>
	  <link  rel="stylesheet" href="css/quizStyle.css">
	
	</head>
	<body>
		
		<header id="section" class="container-fluid text-center">
		    <h1>Section Quiz</h1>
		</header>
		<div id="wrapper" class="container-fluid">
			<div id="matching_area" class="row container-fluid">
				<div class="col-xs-6">
					<h1 id="questionNum" class="text-center"></h1>

					<div class="image_border container-fluid">
						<img id="image" class="img-responsive" draggable="false"  alt="image">
					</div>		
									
				</div>
				
				<div class="col-xs-6">
					<h1>Choose an answer:</h1>
					<div id="choices">
						<h2 class= "select text-center" id="answer1" draggable="false"></h2><audio id="audioPlay1"></audio>
						<h2 class= "select text-center" id="answer2" draggable="false"></h2><audio id="audioPlay2"></audio>
						<h2 class= "select text-center" id="answer3" draggable="false"></h2><audio id="audioPlay3"></audio>
						<h2 class= "select text-center" id="answer4" draggable="false"></h2><audio id="audioPlay4"></audio>
					</div>
					
				</div>
			</div>
			
			<div id="bottom" class="text-center container-fluid">
			      <button type="button" id="prev" class="btn btn-lg btn-default col-xs-6">Previous</button>
			      <button type="button" id="next" class="btn btn-lg btn-default col-xs-6">Next</button>
			</div>
			<div class="container-fluid">
			    
			</div>
			<script src="http://code.jquery.com/jquery.js"></script>
			<?php
			   //Connect to the Database
			    require "db.php";
			  
			  $dbh = new PDO("mysql:host=$hostname; dbname=aviatest_english", $username, $password);
			  if(!$dbh){
				  die("Connection failed: " .mysql_error()); 
			  }
			
			
			  //Use php to grab the maximum number of cards available
			  if(isset($_GET['secid'])){
			      $STM = $dbh->prepare("SELECT count(*) FROM Cards WHERE secid = " . $_GET['secid']);
			  }
			  $STM->execute();
			  $STMrecords = $STM->fetchAll();
			  //create a variable to store the maximum number of cards
			  $numCards = $STMrecords[0];
		      
			  //Print out an error that there are not enough cards to play the game
			  if ($numCards < 4) {
			      print "<h1>THERE ARE NOT ENOUGH CARDS IN THIS SECTION TO PLAY THE GAME, PLEASE CONTACT YOUR INSTRUCTOR</h1>";
			  }
			  
			  //Create Struct to hold card info
			  class CardStruct{
			    public $id;
			    public $word;
			    public $image;
			    public $audio;
			    public $sentence;
			  }
			  
			  //Array of cards in PHP
			  $deck[(int)$numCards];
			
			  //pull the card section default to 1? 
			  $STM = $dbh->prepare("SELECT term, img, audio, sentence FROM Cards WHERE secid = 1");
			  //Test statement to grab the _GET section
			  if(isset($_GET['secid'])){
			    //sectionid is passed from the index to the post array
			    $STM = $dbh->prepare("SELECT term, img, audio, sentence FROM Cards WHERE secid = ".urldecode($_GET['secid']));
			  }
			  $STM->execute();
			  $STMrecords = $STM->fetchAll();
			  $idIncrementer = 1;
			  foreach($STMrecords as $row){
			    //initialize a struct
			    $deck[($idIncrementer-1)] = new CardStruct();
			    $deck[($idIncrementer-1)]->id = "$idIncrementer";
			    $deck[($idIncrementer-1)]->word = "$row[0]";
			    $deck[($idIncrementer-1)]->image = "$row[1]";
			    $deck[($idIncrementer-1)]->audio = "$row[2]";
			    $deck[($idIncrementer-1)]->sentence = "$row[3]";
			    
			    //Increments ID
			    $idIncrementer++;
			  }
			  
			?>
			<script>
			  var card = <?php echo json_encode($deck); ?>;
			</script>
			<script src="script/cardManager2.js"></script>
			<script src="script/quiz2Script.js"></script>
		    </div>
		
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h1 class="modal-title" id="myModealLabel">Quiz Tutorial</h>
		      </div>
		      <div class="modal-body">

			

			<div class="row">
			    <h3><b>Step 1:</b></h3>
			<p class="text-center">You will see an image. You must match the term from the right side with the image. Click a term to hear the word!
			</p>
			<br>
			    <img id='tutorial1' class="img-responsive" src="images/testTutorialCapture.png">
			</div>
			<hr>
			<div class="row">
			    <h3><b>Step 2:</b></h3>
			<p class="text-center">To answer a question, click the term then click "Next". The answer will turn green if correct or red if incorrect.
			</p>
			    <img id='tutorial2' class="img-responsive" src="images/testTutorialCapture2.png">
			</div>
		      </div>
		      <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		
		<footer class="container-fluid">
		  <hr>
		  <p>
		    <a href="main.php" class="buttons"><img id='menu' src="images/menu.png" alt="menu"></a>
		    <!-- Button trigger modal -->
		    <img id='question' src="images/question.png" alt="help menu" data-toggle="modal" data-target="#myModal">
		    <a href="admin/index.php">Administration</a>
		  </p>
		</footer>
		
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