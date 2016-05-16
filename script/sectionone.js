/* Sectionone.js
 * This script is a container for the cards contained in section
 * one. It also has a function to pull the cards. 
 * Author: Corey Johnson
 * Version: 1.0
 */

var card1 = {
	id: "card1",
	word: "International Civil Aviation Organization (ICAO)",
	audio: "section1/audio/internationalCivilAviationOrganization.mp3",
	image: "section1/images/term1.jpg",
	description: "The ICAO is responsible for global aviation."
};

var card2 = {
	id: "card2",
	word: "Federal Aviation Administration (FAA)",
	audio: "section1/audio/federalAviationAdministration.mp3",
	image: "section1/images/term2.jpg",
	description: "The FAA works hard to maintain safety standards!"
};

var card3 = {
	id: "card3",
	word: "License",
	audio: "section1/audio/license.mp3",
	image: "section1/images/term3.jpg",
	description: "You need a license to fly!"
};

var card4 = {
	id: "card4",
	word: "Temporary License",
	audio: "section1/audio/temporaryLicense.mp3",
	image: "section1/images/term4.jpg",
	description: "A temporary license will do until the license comes in the mail."
};

var card5 = {
	id: "card5",
	word: "Airplane Flight Manual",
	audio: "section1/audio/airplaneFlightManual.mp3",
	image: "section1/images/term5.jpg",
	description: "Make sure you read the airplane flight manual before flying."
};

var card6 = {
	id: "card6",
	word: "Helicopter",
	audio: "section1/audio/helicopter.mp3",
	image: "section1/images/term6.jpg",
	description: "A helicopter can hover above the ground!"
};

var card7 = {
	id: "card7",
	word: "High Performance Airplane",
	audio: "section1/audio/highPerformanceAirplane.mp3",
	image: "section1/images/term7.jpg",
	description: "An F18 is an example of a high performance airplane"
};

var card8 = {
	id: "card8",
	word: "Regional Airline",
	audio: "section1/audio/regionalAirline.mp3",
	image: "section1/images/term8.jpg",
	description: "Regional airlines travel within the local area."
};

var card9 = {
	id: "card9",
	word: "Major Airline",
	audio: "section1/audio/majorAirline.mp3",
	image: "section1/images/term9.jpg",
	description: "Major airlines have a lot of customers that travel daily."
};

var card10 = {
	id: "card10",
	word: "Corporate Flying",
	audio: "section1/audio/corporateFlying.mp3",
	image: "section1/images/term10.jpg",
	description: "Corporate flying is less fun than recreational flying."
};

//Array
var card = [card1, card2, card3, card4, card5, card6, card7, card8,
			card9, card10];
var cardSize = card.length - 1;

function getCards() {
	return card;
}

function getCard(index) {
	return card[index-1];
}