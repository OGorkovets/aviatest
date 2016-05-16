/* Sectionfour.js
 * This script is a container for the cards contained in section
 * four. It also has a function to pull the cards. 
 * Author: Corey Johnson
 * Version: 1.0
 */

var card1 = {
	id: "card1",
	word: "Atmosphere",
	audio: "section8/audio/",
	image: "section8/images/term1.jpg",
	description: "Sentence needed"
};

var card2 = {
	id: "card2",
	word: "International Standard Atmosphere",
	audio: "section8/audio/",
	image: "section8/images/term2.jpg",
	description: "Sentence needed"
};

var card3 = {
	id: "card3",
	word: "Forecast Winds And Temperatures Aloft
Chart (FD)",
	audio: "section8/audio/",
	image: "section8/images/term3.jpg",
	description: "Sentence needed"
};

var card4 = {
	id: "card4",
	word: "Convection",
	audio: "section8/audio/",
	image: "section8/images/term4.jpg",
	description: "Sentence needed"
};

var card5 = {
	id: "card5",
	word: "High",
	audio: "section8/audio/",
	image: "section8/images/term5.jpg",
	description: "Sentence needed"
};

var card6 = {
	id: "card6",
	word: "Isobars",
	audio: "section8/audio/",
	image: "section8/images/term6.jpg",
	description: "Sentence needed"
};

//Array
var card = [card1, card2, card3, card4, card5, card6];
var cardSize = card.length - 1;

function getCards() {
	return card;
}

function getCard(index) {
	return card[index-1];
}