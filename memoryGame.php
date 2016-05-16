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
<!DOCTYPE html>

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
      <title>Memory Game</title>
      <link  rel="stylesheet" type="text/css" href="css/memoryStyle.css">
  </head>

  <body>
    <div class="container-fluid">
      <div class = "row col-md-12">
        <div class="col-md-6">
          <a href="main.php" class="buttons"><img class="buttons img-responsive" src="images/menu.png" alt="menu"></a>
        </div>
        
        <div class="col-md-6">
          <a id="resetId" onClick="newBoard()"><img class="pull-right buttons img-responsive" src="images/reset.png" alt="reset game"></a>
        </div>
      </div>
      <div class= "row">
        <div id ="memory_board" class="container col-md-4 col-md-offset-4">
        </div>
      </div>
    </div>
    
    <!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h1 class="modal-title" id="myModealLabel">Memory Game Tutorial</h>
		      </div>
		      <div class="modal-body">

			

			<div class="row">
			    <h3><b>Layout</b></h3>
			<p class="text-center">The top left button is a menu button. This returns you to the main page!<br>
			<br> On the right hand side is the reset button. This will reset the game board, so that all tiles are blank! <br>
				<br>Finally, in the center is the game board!
                        </p>
			<br>
			    <img id='tutorial1' class="img-responsive" src="images/mgtut1.png">
			</div>
			<hr>
			<div class="row">
			    <h3><b>Selecting Cards</b></h3>
			<p class="text-center">To flip a card over, click on one of the "?" cards!
			</p>
			    <img id='tutorial2' class="img-responsive" src="images/mgtut2.png">
			</div>
                        <hr>
                        <div class="row">
			    <h3><b>Completing the Game</b></h3>
			<p class="text-center">To complete the game, you must match all the terms. <br>The matches must be the same term!
                        Once you have finished the game, the board will reset. <br>Have fun!
			</p>
			    <img id='tutorial2' class="img-responsive" src="images/mgtut3.png">
			</div>
		      </div>
		      <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
    

    <?php 
      //Get the card section script initializer 
      require "sectionGrabber.php";
      require "memScript.php";
    ?>
    <footer class="container-fluid">
      <hr>
      
      <!-- Button trigger modal -->
		    <img id='question' src="images/question.png" alt="help menu" data-toggle="modal" data-target="#myModal">
      <a href="admin/index.php">Administration</a>
    </footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>
    
  </body>
</html>