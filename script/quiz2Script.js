   var question = 0; // Amount of questions to ask
    var correct = 0; // Number of correct
    var total = 3; // Total amount of questions
    var correctNum = null;
    var arrayAns; //Array that holds the answers per multiple choice question.

    var anscard1 = null;
    var anscard2 = null;
    var anscard3 = null;
    var anscard4 = null;
    var  choice = null;
    
    var masterArray =[]; //empty array
    var selection = null;
    var isCorrect = null;
    
var main = function(){
    
    //Prevents cards from being initialized more than once
    if (question<1){
        // Loads question based on the variable total
        createQuestion();
        question = 1;
    }
    
    if (question <2) {
            question = 1;
            correct = 0;
            document.getElementById("prev").style.visibility = "hidden";
    }
    
    // Once questions answered then result page loads.
    if(question > total){

        window.location = "quizResult.php?var1=" + correct;

    }
    else
    {
    
    $(".select").removeClass("incorrect correct");
    
    //Load cards based on question
    anscard1 = masterArray[question-1].choice1;
    anscard2 = masterArray[question-1].choice2;
    anscard3 = masterArray[question-1].choice3;
    anscard4 = masterArray[question-1].choice4;
    correctNum = masterArray[question-1].correct;
    arrayAns = [anscard1, anscard2, anscard3, anscard4];
    
            //Initialize quetion based on answer
            $("#answer1").text(arrayAns[0].word);
            $("#answer2").text(arrayAns[1].word);
            $("#answer3").text(arrayAns[2].word);
            $("#answer4").text(arrayAns[3].word);
    
            $("#audioPlay1").attr("src", arrayAns[0].audio);
            $("#audioPlay2").attr("src", arrayAns[1].audio);
            $("#audioPlay3").attr("src", arrayAns[2].audio);
            $("#audioPlay4").attr("src", arrayAns[3].audio);
            
            

            //Counter that displays the question user is on
            document.getElementById("questionNum").innerHTML = "Question " + question + " of " + total;

            
            // Questions image and audio
            $("#image").attr("src", arrayAns[correctNum-1].image);
       }
document.getElementById("answer1").addEventListener("click", function(){selectAnswer(arrayAns,0,correctNum-1)});
document.getElementById("answer2").addEventListener("click", function(){selectAnswer(arrayAns,1, correctNum-1)});
document.getElementById("answer3").addEventListener("click", function(){selectAnswer(arrayAns,2, correctNum-1)});
document.getElementById("answer4").addEventListener("click", function(){selectAnswer(arrayAns,3, correctNum-1)});
document.getElementById("prev").addEventListener("click", prev);
document.getElementById("next").addEventListener("click", next);
};

// When choice is selected the answer will turn green or red depending on if correct
function selectAnswer(e,i,check) {
        
        //Removes any selected answers previously
        //$('.select').removeClass('incorrect correct');
        
        //Plays the audio for selected
        document.getElementById("audioPlay"+(i+1)).load();
        document.getElementById("audioPlay"+(i+1)).play();
        //alert("Index: "+i+"Correct:"+check+"\nWordChoice: "+e[i].word+"Correct:"+e[check].word);
        // Changes color on selection based on correct answer
        $(".select").on("click", function(event){
            	  
            if (e[i].word == e[check].word){
                $(".select").removeClass("incorrect correct").filter(this).addClass("correct");
                isCorrect = true;
            }
            else if (e[i].word != e[check].word){
                $('.select').removeClass('incorrect correct').filter(this).addClass("incorrect");
                isCorrect = false;
            }
        });
        
}
    
// Plays audio word selected
function playAudio(){
        document.getElementById("audioPlay1").load();
        document.getElementById("audioPlay1").play();
}
    
//Creates questions and answers based on the total questions
function createQuestion(){
       
    for (i=0; i < total; i++){
            // Randomize cards
            anscard1 = getCard(Math.floor((Math.random() * card.length) + 1));
                 
            anscard2 = getCard(Math.floor((Math.random() * card.length) + 1));
            while(anscard1 == anscard2){
                anscard2 = getCard(Math.floor((Math.random() * card.length) + 1));
            }       
            anscard3 = getCard(Math.floor((Math.random() * card.length) + 1));
            
            while(anscard3 == anscard2 || anscard3 == anscard1){
                anscard3 = getCard(Math.floor((Math.random() * card.length) + 1));
            }    
            anscard4 = getCard(Math.floor((Math.random() * card.length) + 1));
            
            while(anscard4 == anscard2 || anscard4 == anscard1 || anscard4 == anscard3){
                anscard4 = getCard(Math.floor((Math.random() * card.length) + 1));
            }
            //Test answers with previous ones
            arrayAns = [anscard1, anscard2, anscard3, anscard4];
            
            // Pick answer
            correctNum = Math.floor((Math.random() * 4) + 1);
            
            //Make sure the answers are not duplicate
            
            
            // Build questions and answer into a master list.
            masterArray.push({"choice1": anscard1, "choice2": anscard2, "choice3": anscard3, "choice4": anscard4, "correct": correctNum});
    }
}
   
//Moves to previous question
function prev(){
    if (question <2) {
            question = 1;
            correct = 0;
            document.getElementById("prev").style.visibility = "hidden";
    }else{
            question--;
            correct--;
            document.getElementById("next").style.visibility = "visible";
            $('.select').removeClass('incorrect correct');
            main();
    }
}

//Moves to next question
function next(){
    if (question > masterArray.length) {
            document.getElementById("next").style.visibility = "hidden";
            window.location = "quizResult.php?var1=" + correct;
                    
    }else{
            if (isCorrect) {
                correct++;
            }
            document.getElementById("prev").style.visibility = "visible";
            question++;
            main();
    }
  
}


$(document).ready(main);

    
