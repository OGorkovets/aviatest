<?php
//*** Start a session
  session_start();
  //*** Start the buffer
  ob_start();

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <?php


    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        echo "Form was submitted:";
        
        //Flag variable for valid data
        $valid = true;

        // Assign sections POST to sectionID, make easier to use multple times.
        if (!empty($_POST['section']))
        {
            $sectionId = $_POST['section'];
        }
        else{
            $valid = false;
        }
        
        // Retrieve Sentence if available
        if(!empty($_POST['inputSentence']))
        {
            $sentence = $_POST['inputSentence'];
        }else{
            $valid = false;
        }
        
        // Check to make sure Term name is not empty
        if(empty($_POST['inputTerm']))
        {
            $valid = false;
        }
        else{
            
            //Create mp3 audiofile using text to speech from Google for education purposes
            $text = $_POST['inputTerm'];
    
            // Lang can be changed
            $lang = "en";
        
            
            $file = str_replace(' ', '_', $text);
            // Name of the MP3 file generated using the MD5 hash(disabled)
            //$file  = md5($lang."?".urlencode($text));
            
            //Directory change due to where the real directory are stored
            $cd = "../";
            
            // Prepping MP3 pathing for database 
            $sqlAudioFile = "section".$sectionId."/audio/" . $file .".mp3";
            
            // Real pathing for saving audio
            $audioFile = $cd.$sqlAudioFile;
            
            /*
            // verify CHMOD 777 is not the best permission,can be changed.
            if(substr(sprintf('%o', fileperms('audio/')), -4)!="0777")
                chmod("audio/", 0777);
            */
    
            // If the MP3 file exists, do not create a new request apply error message
            if (!file_exists($file))
            {
                if ($valid){
                // Download the content 
                $mp3 = file_get_contents(
                'http://translate.google.com/translate_tts?ie=UTF-8&tl='. $lang. '&q='.urlencode($text));
                file_put_contents($audioFile, $mp3);
                }
            }
            else{
                
                $valid = false;
                $audioErr = "File already exists. Please edit existing file.";
            }
        }
  
      //Image upload process
      
        $target_dir = "section".$sectionId."/images/";
        
        // Finding the extension uploaded to append to changed filename
        $ext = strstr(basename($_FILES["inputFile"]["name"]), '.');
        
        // Change the file name to match with term name
        $newName = $file.$ext;
        
        // Append directory to new name
        $newTarget = $target_dir.$newName;
        
        // Pathing used in uploading to SQl database
        $sqlImageFile = $newTarget;
        
        // Append $cd to $newTarget to make sure image save to proper place.
        $newTarget = $cd.$newTarget;
        
        $target_file = $target_dir . basename($_FILES["inputFile"][name]);
        $uploadOk = 1;
         
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["inputFile"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $valid = false;
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $valid = false;
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
            $valid = false;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if ($valid){
                if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $newTarget)) {
                    echo "The file ". $newTarget. " has been uploaded.";
                    
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $valid = false;
                }
            }
        }
        
        //If the data is valid, write to DB
        if (($valid) && ($uploadOk)) {
            $sql = "INSERT INTO Cards (secid, term, img, audio, sentence)
            VALUES (:secid, :term, :img, :audio, :sentence)";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':secid', $sectionId, PDO::PARAM_STR);
            $statement->bindParam(':term', $text, PDO::PARAM_STR);
            $statement->bindParam(':img', $sqlImageFile, PDO::PARAM_STR);
            $statement->bindParam(':audio', $sqlAudioFile, PDO::PARAM_STR);
            $statement->bindParam(':sentence', $sentence, PDO::PARAM_STR);
            $statement->execute();
            
            echo "Upload Complete";
           
        }else {
            echo "Oops please make sure all information is filled out.";
        }
    }
  ?>
    <form role="form" action="adminMenu.php?page=cards&nav=cardAdd" method="post" enctype="multipart/form-data">
     <div class="form-group">
        <label>Choose a Section to save to:</label>
        <select class="inputFormat" name="section" id="section">
          
          <?php
            //Display the Available sections to add too
              $sql="SELECT MAX(secid) FROM Section";
              $result = $dbh->query($sql);
              $row = $result->fetch();
                  
              for ($i = 1; $i <= $row[0]; $i++)
              {
                  printf("<option value='%s'>Section %s</option>", $i, $i);
              }
          ?>
        </select>
                        
      </div>
      <div class="form-group">
        <label for="inputTerm">Term</label>
        <input type="text" class="form-control" name= "inputTerm" id="inputTerm" placeholder="Enter Term">
      </div>
      <div class="form-group">
        <label for="inputSentence">Term used in a sentence:</label>
        <input type="text" class="form-control" name="inputSentence" id="inputSentence" placeholder="Enter Sentence">
      </div>
      <div class="form-group">
        <label for="inputFile">File input</label>
        <input type="file" name="inputFile" id="inputFile">
        <p class="help-block">Make sure the file format is .png or jpg</p>
      </div>
      <button type="submit" class="btn btn-primary">Add Card</button>
    </form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<?php
 //Flush buffer
 ob_flush();
?>