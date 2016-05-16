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
              // Count the max users
              $maxPas = count($_POST['newPass']);
              // Put into an array and variable
              $compareEmail = $_POST['email'];
              $newPassword = $_POST['newPass'];
              $confirmPassword = $_POST['confirmPass'];
              // Prepare database
              $sql = "UPDATE AdminInfo SET password = :value where email = :email";
              $statement = $dbh->prepare($sql);
             
              //Password
              for($count = 0; $count < $maxPas; $count++)
              {
                                   if ($newPassword[$count] === $confirmPassword[$count])
                                   {
                                          echo $newPassword[$count]. " ". $confirmPassword[$count];
                                          if (strlen($newPassword[$count]) < 8)
                                          {
                                                 $passErr = "<p class='error'>Password needs to be a minimum of 8 characters long.</p>";
                                                 $validPassword = false; 
                                          }
                                          else
                                          {
                                                 echo "Sent to database!";
                                                 $statement->bindParam(':value', $newPassword[$count]);
                                                 $statement->bindParam(':email', $compareEmail[$count]);
                                                 $statement->execute();  
                                          }
                                          
                                   }
                                   else{
                                          $passErr = "<p class='error'>The password entered is missmatched!</p>";
                                   }
                     
                     
              }      
        
       }
    
?>

<h2>List of Administrators:</h2>
<form role="form" action="adminMenu.php?page=admins&nav=adminPassword" method="post">
       <div class="form-group">
            <table width="100%" class="display" id="table" cellspacing="0">
                   <thead>
                          <tr>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Email</th>
                                 <th>New Password</th>
                                 <th>Confirm Password</th>
                          </tr>
                   </thead>
               
                   <tfoot>
                          <tr>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Email</th>
                                 <th>New Password</th>
                                 <th>Confirm Password</th>
                          </tr>
                   </tfoot>
                   <tbody>
                      
                          <?php
              
                              //Display contacts from database
                              $sql = "SELECT adminFirst, adminLast, email FROM AdminInfo ORDER BY adminLast, adminFirst";
                              $result = $dbh->query($sql);
                              foreach ($result as $row) {
                                  printf("<tr><td>%s</td>", $row['adminFirst']);
                                  printf("<td>%s</td>", $row['adminLast']);
                                  printf("<td>%s</td><input type='hidden' name='email[]' value='%s'>", $row['email'], $row['email']);
                                  printf("<td><input type='text' class='form-control input-large search-query' name='newPass[]'></td>");
                                  printf("<td><input type='text' class='form-control input-large search-query' name='confirmPass[]'></td><td><span class='error'>".$passErr."</span></td></tr> ");
                              }
                                   
                            ?>
                                
                   </tbody>
            </table>
       </div>
       <div class="form-group">
              <button type="submit" class="btn btn-primary">Change User Account</button>
       </div>
</form>


        

</html>

<?php
 //Flush buffer
 ob_flush();
?>