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
    
    
        // Checks to make sure dropdown set with value;
        if (($_POST['lock'] == 0) || ($_POST['lock'] == 1)){
            
            $lock = $_POST['lock'];
        }
        else{
            $valid = false;
            echo "Lock = false";
        }
        
        // Checks to make sure section value not empty
        if (!empty($_POST['section'])){
            $section = $_POST['section'];
        }
        else{
            $valid = false;
        }
        
        
        

        //If the data is valid, write to DB
        
        if ($valid) {
            
            // Since user might hit submit twice once the value was added, checking to make sure not added again in error.
            $compareSql = "select sectitle from Section where sectitle = '".$section."'";
            $compareStatement = $dbh->query($compareSql);
            $compareRow = $compareStatement->fetch();
            $test = $compareRow[0];
            if ($section === $test){
                echo "Section was already added.";
            }
            else{
                $sql = "INSERT INTO Section (sectitle, locked)
                    VALUES (:sectitle, :locked)";
                $statement = $dbh->prepare($sql);
                $statement->bindParam(':sectitle', $section, PDO::PARAM_STR);
                $statement->bindParam(':locked', $lock, PDO::PARAM_STR);
                $statement->execute();
                echo "Sent to database";
            }
        }
        else{
            echo "We have a problem!";
            echo "<p>Invalid info being submitted:".$section."</p>";
            echo "<br>";
            echo "<p>Invalid info being submitted:".$lock."</p>";
        }
        
        
    }
    
?>
<h2>Section Add</h2>
<form role="form" action="adminMenu.php?page=sections&nav=sectionAdd" method="post">
    <div class="form-group form-group-lg">
          <label>Adding: 
              <span>
                  <?php
                      //Find the highest section and add 1 
                      $sql="SELECT MAX(secid) FROM Section";
                      $result = $dbh->query($sql);
                      $row = $result->fetch();
                      $section = $row[0] +1;    
                      $section = "Section".$section;
                      echo $section;
                  ?>
              </span>
          </label>
          <input type="hidden" class="form-control" name="section" id="section" value= "<?php echo $section; ?>">
      </div>
    
    <div class="form-group form-group-lg">
        <label>
            <select name="lock" id="lock">
                <option value="0">Unlock Section</option>
                <option value="1">Lock Section</option>
                
            </select>
        </label>
    </div>
    <div class="form-group">
  <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>

<?php
 //Flush buffer
 ob_flush();
?>