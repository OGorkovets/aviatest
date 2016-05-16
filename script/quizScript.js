(function(){
    var question = 1; // Amount of questions to ask
    var correct = 0; // Number of correct
    var total = 3; // Total amount of questions
    var correctNum = null;


    var time; // Timer variable to set and clear function
    var timerOn = 0;
    var changeCounter = 30;
    var counter = 0;

    // Plays audio when click image
    function playAudio(){
        document.getElementById("audioPlay").load();
        document.getElementById("audioPlay").play();
    }

    // Remove the 'empty' and 'filled' part of the id's and compare the rest of the strings. 
    function checkShapeDrop(e, correctInt) { 
        var element = e.dataTransfer.getData('text');

        // Prevents default code for drop to execute
        e.preventDefault();
      
          
        // if we have a match, replace replace the background color of
        if (element == ("answer"+ correctInt)) {
            document.getElementById("leftBox").className = "correct";
        
            setTimeout(function() {
                document.getElementById("leftBox").className = "left";
            },(1000));

            correct = correct + 1;
            
        } 
        else { 
            //not a match turns red
            document.getElementById("leftBox").className = "incorrect";

            setTimeout(function() {
                document.getElementById("leftBox").className = "left";
            },(1000));

        } 
        
        stopCount();
        question = question + 1;
        initialize();
    }

      // When dragging starts, set dataTransfer's data to the element's id.
    function startShapeDrag(e) {
        e.dataTransfer.setData('text', this.id);
    }

        // Assign event listeners to the divs to handle dragging.
    function initialize() 
    {    
        // Boolean keeps track of question. If question is answered timer 
        // stops and resets.
        var anscard1 = null;
        var anscard2 = null;
        var anscard3 = null;
        var anscard4 = null;
        var anscard5 = null;
        
        // Once questions answered then result page loads.
        if(question > total){

            window.location = "quizResult.php?var1=" + correct;

        }
        else
        {
        
            // Randomize cards
            anscard1 = getCard(Math.floor((Math.random() * 10) + 1));
                
            anscard2 = getCard(Math.floor((Math.random() * 10) + 1));
            while(anscard1 == anscard2){
                anscard2 = getCard(Math.floor((Math.random() * 10) + 1));
            }
            
            anscard3 = getCard(Math.floor((Math.random() * 10) + 1));
            while(anscard3 == anscard2 || anscard3 == anscard1){
                anscard3 = getCard(Math.floor((Math.random() * 10) + 1));
            }
            
            anscard4 = getCard(Math.floor((Math.random() * 10) + 1));
            while(anscard4 == anscard2 || anscard4 == anscard1 || anscard4 == anscard3){
                anscard4 = getCard(Math.floor((Math.random() * 10) + 1));
            }

            anscard5 = getCard(Math.floor((Math.random() * 10) + 1));
            while(anscard5 == anscard2 || anscard5 == anscard1 || anscard5 == anscard3 || anscard5 == anscard4){
                anscard5 = getCard(Math.floor((Math.random() * 10) + 1));
            }

            var arrayAns = [anscard1, anscard2, anscard3, anscard4, anscard5];
            
            //Counter that displays the question user is on
            document.getElementById("questionNum").innerHTML = "Question " + question + " of " + total;

            // Pick answer
            correctNum = Math.floor((Math.random() * 5) + 1);

            // if it is the first question than the correct number is stored in previous correct.
            // This is used to compare newer questions with the previous to minimize duplicate questions.
            if (question == 1){

                prevCorrect = correctNum;
            }
            else{

                while (correctNum == prevCorrect){
                    correctNum = Math.floor((Math.random() * 5) + 1);
                }
               prevCorrect = correctNum; 
            }

            //Initialize first quetion
            $("#answer1").text(arrayAns[0].word);
            $("#answer2").text(arrayAns[1].word);
            $("#answer3").text(arrayAns[2].word);
            $("#answer4").text(arrayAns[3].word);
            $("#answer5").text(arrayAns[4].word);

            $("#image").attr("src", arrayAns[(correctNum -1)].image);
            $("#audioPlay").attr("src", arrayAns[(correctNum -1)].audio);
            
            startCount(); // Start count down based on global counter variable.
       }      
    }

    document.getElementById("answer1").addEventListener("dragstart", startShapeDrag, false);
    document.getElementById("answer2").addEventListener("dragstart", startShapeDrag, false);
    document.getElementById("answer3").addEventListener("dragstart", startShapeDrag, false);
    document.getElementById("answer4").addEventListener("dragstart", startShapeDrag, false);
    document.getElementById("answer5").addEventListener("dragstart", startShapeDrag, false);
    document.getElementById("box_input").addEventListener("drop", function(){checkShapeDrop(event, correctNum)}, false);
    document.getElementById("image").addEventListener("click", playAudio, false);
   document.addEventListener("DOMContentLoaded", initialize, false);
   
   
    // Used to display count down timer and if timer reaches zero than 
    // the question is counted and next question is asked.
    function timedCount(){
        var displayCounter = document.getElementById("timer");
        
        displayCounter.innerHTML = counter;
        
        if (counter < 0){
            displayCounter.innerHTML = "Time's\nup!";
            stopCount();
            question = question + 1;
            initialize();
        }
        else
        {
            counter = counter - 1;
            time = setTimeout(function(){timedCount()}, 1000);
        }
    }

       function startCount()
       {
            counter = changeCounter;

            if (!timerOn) 
            {
                
                timerOn = 1;
                timedCount();
            }
       }

       function stopCount(){
            clearTimeout(time);
            timerOn = 0;
       }

       

}) ();