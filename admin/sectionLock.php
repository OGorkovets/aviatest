<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
    ob_start();
   
    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Isset used for buttons
        //echo "Form was submitted.";
        
        //Flag variable for valid data
        $valid = true;
        $sql="SELECT count(secid) FROM Section";
        $result1 = $dbh->query($sql);
        $number = $result1->fetch();
        // Keep track of how many sections are available
        $maxCount = $number[0];

        //If the data is valid, write to DB
        
                    
            $sql = "UPDATE Section SET locked = :value WHERE sectitle = :key";
            $statement = $dbh->prepare($sql);
            
            for ($i = 1; $i <= $maxCount; $i++)
            {
                $sec = "Section".$i;

                $statement->bindParam(':key',$_POST[$i]);
                $statement->bindParam(':value',$_POST[$sec]);
                $statement->execute();
            }    
            echo "Sent to database";
        
        
    }
    
?>

<form role="form" action="adminMenu.php?page=sections&nav=sectionLock" method="post">
     <div class="form-group">
        <h2>Choose a Section to lock or unlock:</h2>
        
        <!-- <table width="100%" class="display" id="table" cellspacing="0"> -->
        <table width="100%" class="display" cellspacing="0">
            <thead>
                <tr>
                    <th>Section#</th>
                    <th>Unlock</th>
                    <th>Lock</th>
                </tr>
            </thead>
     
            <tfoot>
                <tr>
                    <th>Section#</th>
                    <th>Unlock</th>
                    <th>Lock</th>
                </tr>
            </tfoot>

            <tbody>
              <?php
                //Display the Available sections to add too
                  $sql="SELECT secid, sectitle, locked FROM Section ORDER BY secid";
                  $result = $dbh->query($sql);
                  // Display the sections locked or unlocked
                   foreach ($result as $row) {
                        printf("<tr><td>%s</td><input type='hidden' id='title' name='%s' value = '%s'>", $row['sectitle'], $row['secid'], $row['sectitle']);
                        if ($row['locked'] == 1){
                            printf("<td><input type='radio' name='%s' value = '0'>Unlock</td>", $row['sectitle']);
                            printf("<td><input type='radio' name='%s' value = '1' checked='checked'>Lock</td></tr>", $row['sectitle']);
                        }else if ($row['locked'] == 0){
                            printf("<td><input type='radio' name='%s' value = '0' checked='checked'>Unlock</td>", $row['sectitle']);
                            printf("<td><input type='radio' name='%s' value = '1'>Lock</td></tr>", $row['sectitle']);
                        }
                    }
              ?>
            </tbody>
        </table>
        
        
                        
    </div>
      
      <button type="submit" class="btn btn-primary" >Update</button>
    </form>
<?php
 //Flush buffer
 ob_flush();
?>