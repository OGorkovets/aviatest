/* Sectionthree.js
 * This script is a container for the cards contained in section
 * three. It also has a function to pull the cards. 
 * Author: Corey Johnson
 * Version: 1.0
 */
var card1 = {
	id: "card1",
	word: "Aerodynamic Forces",
	audio: "section8/audio/aerodynamicForces",
	image: "section8/images/term1.jpg",
	description: "Sentence needed"
};

var card2 = {
	id: "card2",
	word: "Magnetic Variation",
	audio: "section8/audio/magneticVariation.mp3",
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

var card7 = {
	id: "card7",
	word: "Low",
	audio: "section8/audio/",
	image: "section8/images/term7.jpg",
	description: "none"
};

var card8 = {
	id: "card8",
	word: "Pressure Gradient",
	audio: "section8/audio/",
	image: "section8/images/term8.jpg",
	description: "none"
};

var card9 = {
	id: "card9",
	word: "Lapse Rate",
	audio: "section8/audio/",
	image: "section8/images/term9.jpg",
	description: "none"
};

var card10 = {
	id: "card10",
	word: "Evaporation/Condensation",
	audio: "section8/audio/",
	image: "section8/images/term10.jpg",
	description: "none"
};

var card11 = {
	id: "card11",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term11.jpg",
	description: "none"
};

var card12 = {
	id: "card12",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term12.jpg",
	description: "none"
};

var card13 = {
	id: "card13",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term13.jpg",
	description: "none"
};

var card14 = {
	id: "card14",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term14.jpg",
	description: "none"
};

var card15 = {
	id: "card15",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term15.jpg",
	description: "none"
};

var card16 = {
	id: "card16",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term16.jpg",
	description: "none"
};

var card17 = {
	id: "card17",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term17.jpg",
	description: "none"
};

var card18 = {
	id: "card18",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term18.jpg",
	description: "none"
};

var card19 = {
	id: "card19",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term19.jpg",
	description: "none"
};

var card20 = {
	id: "card20",
	word: "",
	audio: "section8/audio/",
	image: "section8/images/term20.jpg",
	description: "none"
};
//Array
var card = [card1, card2, card3, card4, card5, card6, card7, card8,
			card9, card20];
var cardSize = card.length - 1;

function getCards() {
	return card;
}

function getCard(index) {
	return card[index-1];
}