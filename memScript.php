<?php 
  
  //Use php to grab the maximum number of cards available
  if(isset($_GET['secid'])){
    $STM = $dbh->prepare("SELECT count(*) FROM Cards WHERE secid = ".$_GET['secid']);
  }
  $STM->execute();
  $STMrecords = $STM->fetchAll();
  //create a variable to store the maximum number of cards
  $numCards = $STMrecords[0];
  // Used to add section number to center square
  $sec = $_GET['secid'];

  //Print out an error that there are not enough cards to play the game
  if ($numCards < 4) {
    print "<h1>THERE ARE NOT ENOUGH CARDS IN THIS SECTION TO PLAY THE GAME, PLEASE CONTACT YOUR INSTRUCTOR</h1>";
  }

  print "<script>";

  //Awful spacing, so look at the memoryScript.js if you want to actually read it. 

  print "var memory_array = []; 
          var memory_values = []; 
          var memory_tile_ids = []; 
          var tiles_flipped = 0;";

  //Assign random values to the cards
  $card1 = rand(1, $numCards[0]);
  $card2 = rand(1, $numCards[0]);
  while($card2 == $card1){
    $card2 = rand(1, $numCards[0]);
  }
  $card3 = rand(1, $numCards[0]);
  while($card3 == $card1 || $card3 == $card2){
    $card3 = rand(1, $numCards[0]);
  }
  $card4 = rand(1, $numCards[0]);
  while($card4 == $card1 || $card4 == $card2 || $card4 == $card3){
    $card4 = rand(1, $numCards[0]);
  }

  print "cardSet1 = getCard($card1);";
              
  print "cardSet2 = getCard($card2);";

  print "cardSet3 = getCard($card3);";

  print "cardSet4 = getCard($card4);";

  print "memory_array.push(cardSet1);
         memory_array.push(cardSet1);
         memory_array.push(cardSet2);
         memory_array.push(cardSet2);
         memory_array.push(cardSet3);
         memory_array.push(cardSet3);
         memory_array.push(cardSet4);
         memory_array.push(cardSet4);";

  print "Array.prototype.memory_tile_shuffle = function(){
    var i = this.length, j, temp;
    while (--i > 0){
      j = Math.floor(Math.random() * (i+1));
      temp = this[j];
      this[j] = this[i];
      this[i] = temp;
    }
  }";

  print "
  function newBoard(){
    tiles_flipped = 0;
    var output = \"\";
    memory_array.memory_tile_shuffle();
    
    for (var i = 0; i < memory_array.length; i++){
      
      if (i == 4){
        output +='<div id=\"center\" class=\"col-md-1\">Section<br>'+$sec+'</div>';
      }
      output += '<div class=\"col-md-1 clickableTIle\" id = \"title_' +i+ '\" onClick=\"memoryFlipTile(this,\''+memory_array[i].word+'\', \''+memory_array[i].audio+'\')\"></div>';
    }
    
    document.getElementById('memory_board').innerHTML = output;
    
  }";

  print "
  function memoryFlipTile(tile, val, audio) { 
    if(tile.innerHTML == \"\" && (memory_values.length < 2)) {
      tile.style.background = '#FFF';
      tile.innerHTML = '<h3 class=\"text-center\">' +val+ '</h3><audio id=\"audioPlay\" src= \"' +audio+'\" autoplay></audio>';
      if(memory_values.length == 0) {
        memory_values.push(val);
        memory_tile_ids.push(tile.id);
      } 
      else if(memory_values.length == 1){
        memory_values.push(val);
        memory_tile_ids.push(tile.id);
        if(memory_values[0] == memory_values[1]){
          document.getElementById(memory_tile_ids[0]).style.background = 'green';
          document.getElementById(memory_tile_ids[1]).style.background = 'green';
          tiles_flipped += 2;
          memory_values = [];
          memory_tile_ids = [];
          if(tiles_flipped == memory_array.length){
            alert(\"Congratulations!\");
            document.getElementById('memory_board').innerHTML = \"\";newBoard();
          }
        } 
        else { 
          function flip2Back(){
            var tile_1 = document.getElementById(memory_tile_ids[0]);
            var tile_2 = document.getElementById(memory_tile_ids[1]);
            tile_1.css = 'img-thumbnail img-responsive';
            tile_1.style.background = 'url(images/memoryGameCard.png) no-repeat';
            tile_1.style.backgroundSize = '200px 200px';
            tile_1.innerHTML = \"\";
            tile_2.style.background = 'url(images/memoryGameCard.png) no-repeat';
            tile_2.css = 'img-thumbnail img-responsive';
            tile_2.style.backgroundSize = '200px 200px';
            tile_2.innerHTML = \"\";
            memory_values = [];
            memory_tile_ids = [];
          }
          setTimeout(flip2Back, 2000);
        }
      }
    }
  } 
  window.addEventListener(\"load\", newBoard(), false);";

  print "</script>";
?>