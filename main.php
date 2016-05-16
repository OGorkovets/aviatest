<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
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
      <title>Main Page</title>
      <!--Styles Linked -->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
 
  </head>

  <body>
    <div class="conatiner-fluid">
      <div class="row container-fluid">
      <ul class="nav nav-pills">
        <li>
          <a class="logout" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
      <div class="row text-center">
        <h1 class="header">Aviation English</h1>
        <br>
        <p class="header">Welcome to the Aviation website for Green River Community College. Please click on a section to get started!</p>
      </div>
      <div id='accordion' class="container-fluid">
        
        <?php
          //Connect to the Database
          require "db.php";

          try {
            $dbh = new PDO("mysql:host=$hostname;
                           dbname=aviation_aviation", $username, $password);
            //echo "Connected to database.";
          } 
          catch (PDOException $e) {
            echo $e->getMessage();
          }

          $STM = $dbh->prepare("SELECT count(*) FROM Section");
          //Test statement to grab the _POST section
          $STM->execute();
          $STMrecords = $STM->fetch();
          $sectionIncrementer=1;
          while($sectionIncrementer <= $STMrecords[0]){
            $STM = $dbh->prepare("select  s.* from Section s natural join Cards c WHERE s.secid = $sectionIncrementer and s.locked = '0'  and c.secid = $sectionIncrementer HAVING count(*) >=4");
            $STM->execute();
            $records = $STM->fetch();
            
            if ($records[0]> 0){
              print "<h2>Section $sectionIncrementer</h2>
                <div class='content'>
                    <a class='col-xs-4' id=\"one\" href=\"flashcard.php?secid=".urlencode($sectionIncrementer)."\"><img class='links img-responsive' src=\"images/flashcard.png\"><h2>Flash Cards</h2></a> 
                    <a class='col-xs-4' href=\"memoryGame.php?secid=".urlencode($sectionIncrementer)."\"><img class='links img-responsive' src=\"images/memoryGame.png\"><h2>Memory Game</h2></a>
                    <a class='col-xs-4' href=\"quiz.php?secid=".urlencode($sectionIncrementer)."\"><img class='links img-responsive' src=\"images/quiz.png\"><h2>Quiz</h2></a>
                </div>";
            }
            $sectionIncrementer++;
          }
        print "</div>";
      
    ?>
  </div>
    
      <footer class="panel-footer">
       
        <img class="center-block img-responsive" src="images/green-river-logo-white.png" alt="Green River Logo">
        <hr>
        <p><a href="admin/index.php">Administration</a></p>
      </footer>
     
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>
    <script src='//code.jquery.com/ui/1.11.2/jquery-ui.js'></script> 
    <script src="script/mainScript.js"></script>
  </body>
</html>
<?php
//Flush buffer
 ob_flush();
?>