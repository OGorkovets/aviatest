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

//Card var instatiations
var card1 = {
	id: "card1",
	word: "International Civil Aviation Organization (ICAO)",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=International%20Civil%20Aviation%Organization%20(ICAO)",
	image: "section1/term1.jpg",
	description: "The ICAO is responsible for global aviation."
};

var card2 = {
	id: "card2",
	word: "Federal Aviation Administration (FAA)",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Federal%20Aviation%20Administration%20(FAA)",
	image: "section1/term2.jpg",
	description: "The FAA works hard to maintain safety standards!"
};

var card3 = {
	id: "card3",
	word: "License",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=license",
	image: "section1/term3.jpg",
	description: "You need a license to fly!"
};

var card4 = {
	id: "card4",
	word: "Temporary License",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Temporary%20license",
	image: "section1/term4.jpg",
	description: "A temporary license will do until the license comes in the mail."
};

var card5 = {
	id: "card5",
	word: "Airplane Flight Manual",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Airplane%20flight%20manual",
	image: "section1/term5.jpg",
	description: "Make sure you read the airplane flight manual before flying."
};

var card6 = {
	id: "card6",
	word: "Helicopter",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=",
	image: "section1/term6.jpg",
	description: "A helicopter can hover above the ground!"
};

var card7 = {
	id: "card7",
	word: "High Performance Airplane",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=",
	image: "section1/term7.jpg",
	description: "An F18 is an example of a high performance airplane"
};

var card8 = {
	id: "card8",
	word: "Regional Airline",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=",
	image: "section1/term8.jpg",
	description: "Regional airlines travel within the local area."
};

var card9 = {
	id: "card9",
	word: "Major Airline",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=",
	image: "section1/term9.jpg",
	description: "Major airlines have a lot of customers that travel daily."
};

var card10 = {
	id: "card10",
	word: "Corporate Flying",
	audio: "http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=",
	image: "section1/term10.jpg",
	description: "Corporate flying is less fun than recreational flying."
};

//Array
var card = getCards();
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