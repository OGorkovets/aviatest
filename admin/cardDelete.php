<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
    ob_start();
    

    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Isset used for buttons
        //echo "Form was submitted.";
        
        // Grabs POST as an array
        $toDelete = $_POST['checkArray'];
        
        $sql = "Delete FROM Cards WHERE audio = :term";
        $statement = $dbh->prepare($sql);
        
        foreach ($toDelete as $imageDir){
            $firstPos = strpos($imageDir,'/',0);
            $secondPos = strpos($imageDir,'/',($firstPos +1));
            
            //Section being deleted from.
            $section = substr($imageDir, 0, $firstPos);
            
            //Isolate the filename that we want to delete from directory
            $filename = substr($imageDir,($secondPos + 1), strlen($imageDir));
            
            //Strip off the extension
            $filename = strstr($filename, '.', true);
            
            //Combine to make audio directory
            $audioDir = $section."/audio/".$filename.".mp3";
           
            $statement->bindParam(':term', $audioDir);
            $statement->execute();
            
            //Prepare to unlink files from correct directory
            $imageDir = "../".$imageDir;
            $audioDir = "../".$audioDir;
            
            // Delete files
            unlink($audioDir);
            unlink($imageDir);
        }
        
        
    }
    
?>

<form role="form" action="adminMenu.php?page=cards&nav=cardDelete" method="post">
     <div class="form-group">
        <h2>Choose Cards to Delete:</h2>
        
        <!--  Shows existing Sections added -->
 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>Delete</th>
                <th>Section</th>
                <th>Term</th>
                <th>Sentence Example</th>
                <th>Image Directory</th>
                <th>Audio Directory</th>
            </tr>
        </thead>
 
        <tfoot>
             <tr>
                <th>Delete</th>
                <th>Section</th>
                <th>Term</th>
                <th>Sentence Example</th>
                <th>Image Directory</th>
                <th>Audio Directory</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT secid, term, sentence, img, audio FROM Cards ORDER BY secid";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    printf("<tr><td><input type='checkbox' name ='checkArray[]' value='%s'></td>",$row['img']);
                    printf("<td>%s</td>", $row['secid']);
                    printf("<td>%s</td>", $row['term']);
                    printf("<td>%s</td>", $row['sentence']);
                    printf("<td>%s</td>", $row['img']);
                    printf("<td>%s</td></tr>", $row['audio']);

                }
            ?>
        </tbody>
    </table>

        
        
                        
    </div>
      
      <button type="submit" class="btn btn-primary" >Delete Card</button>
    </form>
<?php
 //Flush buffer
 ob_flush();
?>