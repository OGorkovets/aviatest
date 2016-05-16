/** Card Manager
  * Authors: Ryan Hendrickson, Corey Johnson, Brandon Degarimore, Casey Morris
  * This script manages the section cards. 
  * Each card contains a term, audio, image, and 
  * sentence. 
  * 
  * Functions:
  * .next() - Goes to the next card
  * .prev() - Goes to the previous card
  * .grid() - Zooms out of the current card to the list of cards
  * .focus() - Zooms into the selected card
  * .quiz() - Sets up the page for a quiz
  *
  *	Version: 0.2
  */

//Globals
var curCard = 0;

//Example of PHP Struct
//class CardStruct{
//    public $id;
//    public $word;
//    public $img;
//    public $audio;
//    public $sentence;
//}

//Array
var cardSize = card.length - 1;

//Functions

/* Update the html on:
	word
	audio
	imageBorder
	desc
*/
function next() {
	$(".word").html("<h2>" + card[curCard].word + "</h2>");
	$("#audioPlay").attr("src",card[curCard].audio);
	$(".imageBorder").attr("src",card[curCard].image);
	$(".desc").html(card[curCard].description);
	if (curCard<cardSize){
		curCard++;
	}
	else if (curCard == cardSize){
		curCard = 0;
	}
};

function prev() {
	if (curCard > 0){
		curCard--;
	}
	else if (curCard == 0){
		curCard = cardSize;
	}
	$(".word").html("<h2>" + card[curCard].word + "</h2>");
	$("#audioPlay").attr("src",card[curCard].audio);
	$(".imageBorder").attr("src",card[curCard].image);
	$(".desc").html(card[curCard].description);
};

function getCards(){
	return card;
};

function getCard(index){
	return card[index-1];
};


function grid() {
	next();
};

function focus() {

};

function quiz() {

};

function getAudio() {
	return curCard.audio;
};