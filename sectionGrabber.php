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

  //pull the card section default to 1? 
  $STM = $dbh->prepare("SELECT term, img, audio, sentence FROM Cards WHERE secid = 1");
  //Test statement to grab the _GET section
  if(isset($_GET['secid'])){
    //sectionid is passed from the index to the post array
    $STM = $dbh->prepare("SELECT term, img, audio, sentence FROM Cards WHERE secid = ".urldecode($_GET['secid']));
  }
  $STM->execute();
  $STMrecords = $STM->fetchAll();

  //create the card script
  print "<script type='text/javascript'>\n";
    print "var curCard = 0;";

    //Initialize a counting variable to incremement card id's
    $idIncrementer = 1;

    //Loop through the STMrecords to grab each row of data
    foreach($STMrecords as $row){
      //initialize a struct
      print "var card$idIncrementer = { \nid: \"card$idIncrementer\", \nword: \"$row[0]\", \nimg: \"$row[1]\", \naudio: \"$row[2]\", \ndescription: \"$row[3]\"\n}; \n";
      $idIncrementer++;
    }

    //Create the array 
    print "var card = [";
    for ($counter = 1; $counter < $idIncrementer; $counter++){
      //add a card to the array
      if ($counter == 1){
        print "card$counter";
      }
      else {
        print ", card$counter";
      }
      
    }

    print "]; \n";

    //Get card array size
    print "var cardSize = card.length - 1; \n";

    //make getter functions
    print "function getCards(){\nreturn card;\n} \nfunction getCard(index){\nreturn card[index-1];\n}\n";

    print "function next() {
        $(\".word\").html(\"<h2>\" + card[curCard].word + \"</h2>\");
        $(\"#audioPlay\").attr(\"src\",card[curCard].audio);
        $(\".imageBorder\").attr(\"src\",card[curCard].img);
        $(\".desc\").html(card[curCard].description);
        if (curCard<cardSize){
          curCard++;
        }
        else if (curCard == cardSize){
          curCard = 0;
        }
      }\n\n

      function prev() {
        if (curCard > 0){
          curCard--;
        }
        else if (curCard == 0){
          curCard = cardSize;
        }
        $(\".word\").html(\"<h2>\" + card[curCard].word + \"</h2>\");
        $(\"#audioPlay\").attr(\"src\",card[curCard].audio);
        $(\".imageBorder\").attr(\"src\",card[curCard].img);
        $(\".desc\").html(card[curCard].description);
      }\n\n";

  print "</script>";
?>