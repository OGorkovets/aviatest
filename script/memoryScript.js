 var memory_array = [];
  var memory_values = [];
  var memory_tile_ids = [];
  var tiles_flipped = 0;

  // Import random set of four cards
  cardSet1 = getCard(Math.floor((Math.random() * 10) + 1));
                
  cardSet2 = getCard(Math.floor((Math.random() * 10) + 1));
  
  while(cardSet1 == cardSet2){
    cardSet2 = getCard(Math.floor((Math.random() * 10) + 1));
  }
            
  cardSet3 = getCard(Math.floor((Math.random() * 10) + 1));
 
  while(cardSet3 == cardSet2 || cardSet3 == cardSet1){
      cardSet3 = getCard(Math.floor((Math.random() * 10) + 1));
  }
  
  cardSet4 = getCard(Math.floor((Math.random() * 10) + 1));
  
  while(cardSet4 == cardSet2 || cardSet4 == cardSet1 || cardSet4 == cardSet3){
      cardSet4 = getCard(Math.floor((Math.random() * 10) + 1));
  }


  memory_array.push(cardSet1);
  memory_array.push(cardSet1);
  
  memory_array.push(cardSet2);
  memory_array.push(cardSet2);

  
  memory_array.push(cardSet3);
  memory_array.push(cardSet3);
  
  memory_array.push(cardSet4);
  memory_array.push(cardSet4);

  memory_array.push(cardSet1);
  memory_array.push(cardSet1);
  
  memory_array.push(cardSet2);
  memory_array.push(cardSet2);

  
  memory_array.push(cardSet3);
  memory_array.push(cardSet3);
  
  memory_array.push(cardSet4);
  memory_array.push(cardSet4);

  
  Array.prototype.memory_tile_shuffle = function(){
    var i = this.length, j, temp;
    while (--i > 0){
      j = Math.floor(Math.random() * (i+1));
      temp = this[j];
      this[j] = this[i];
      this[i] = temp;
    }
  }

  function newBoard(){
    tiles_flipped = 0;
    var output = "";
    memory_array.memory_tile_shuffle();
    for (var i = 0; i < memory_array.length; i++){
      output += '<div id = "title_' +i+ '" onClick="memoryFlipTile(this,\''+memory_array[i].word+'\', \''+memory_array[i].audio+'\')"></div>';
    }
    document.getElementById('memory_board').innerHTML = output;
  }

  function memoryFlipTile(tile, val, audio){
  if(tile.innerHTML == "" && memory_values.length < 2){
    tile.style.background = '#FFF';
    //tile.innerHTML = '<img src= "' +val+ '"><audio id="audioPlay" src= "' +audio+'" autoplay></audio>';
    tile.innerHTML = '<h3>' +val+ '</h3><audio id="audioPlay" src= "' +audio+'" autoplay></audio>';
    if(memory_values.length == 0){
      memory_values.push(val);
      memory_tile_ids.push(tile.id);
    } else if(memory_values.length == 1){
      memory_values.push(val);
      memory_tile_ids.push(tile.id);
      if(memory_values[0] == memory_values[1]){
        tiles_flipped += 2;
        // Clear both arrays
        memory_values = [];
              memory_tile_ids = [];
        // Check to see if the whole board is cleared
        if(tiles_flipped == memory_array.length){
          alert("Congratulations!");
          document.getElementById('memory_board').innerHTML = "";
          newBoard();
        }
      } else {
        function flip2Back(){
            // Flip the 2 tiles back over
            var tile_1 = document.getElementById(memory_tile_ids[0]);
            var tile_2 = document.getElementById(memory_tile_ids[1]);
            tile_1.style.background = 'url(images/memoryGameCard.png) no-repeat';
            tile_1.style.backgroundSize = '140px 140px';
                  tile_1.innerHTML = "";
            tile_2.style.background = 'url(images/memoryGameCard.png) no-repeat';
            tile_2.style.backgroundSize = '140px 140px';
                  tile_2.innerHTML = "";
            // Clear both arrays
            memory_values = [];
                  memory_tile_ids = [];
        }
        setTimeout(flip2Back, 2000);
      }
    }
  }
}

  window.addEventListener("load", newBoard(), false);