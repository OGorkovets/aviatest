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
        // Prepare sql request
        $sql = "Delete FROM AdminInfo WHERE email = :term";
        $statement = $dbh->prepare($sql);
        
        foreach ($toDelete as $adminUser){
            $statement->bindParam(':term', $adminUser);
            $statement->execute();
            
        }
        
        
    }
    
?>

<form role="form" action="adminMenu.php?page=admins&nav=adminDelete" method="post">
     <div class="form-group">
        <h2>Choose Users to Delete:</h2>
        
        <!--  Shows existing Sections added -->
 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>Delete</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
            </tr>
        </thead>
 
        <tfoot>
             <tr>
                <th>Delete</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT adminFirst, adminLast, email FROM AdminInfo ORDER BY adminFirst";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    if ($row['email'] != 'admin@greenriver.edu')
                    {
                        printf("<tr><td><input type='checkbox' name ='checkArray[]' value='%s'></td>",$row['email']);
                        printf("<td>%s</td>", $row['adminFirst']);
                        printf("<td>%s</td>", $row['adminLast']);
                        printf("<td>%s</td></tr>", $row['email']);
                    }
                }
            ?>
        </tbody>
    </table>

        
        
                        
    </div>
      
      <button type="submit" class="btn btn-primary" >Delete Admin</button>
    </form>
<?php
 //Flush buffer
 ob_flush();
?>