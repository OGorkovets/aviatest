<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
    ob_start();

        //Connect to the database
        require "../db.php";
    
       
	$dbh = new PDO("mysql:host=$hostname;
						dbname=aviatest_english", $username, $password);
	if(!$dbh){
		die("Connection failed: " .mysql_error());
	}

 
    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Isset used for buttons
        //echo "Form was submitted.";
        
        //Flag variable for valid data.
        $validPassword = true;
    
        //Password
        if (!empty($_POST['password'])) {
            $password= $_POST['password'];
            if (strlen($password) < 8){
                $passErr = "<p class='error'>Password needs to be a minimum of 8 characters long.</p>";
                $validPassword = false;
            }
        }else{
            $validPassword = false;
        }
        

        //Depending on what is valid, determines what is updated
        if ($validPassword){
            //Password updates only WHERE sectitle = :key
            $sql = "UPDATE UserInfo SET password = :password where id = '1'";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':password',$_POST['password']);
            $statement->execute();
            echo"Password has changed!";
        }
       
        
        
    }
    
?>
<h2>Student Password</h2>
<p>Administrator can change the student's password.</p>
<?php

    //Display contacts from database
    $sql = "SELECT email, password FROM UserInfo";
    $result = $dbh->query($sql);
    foreach ($result as $row)
    {
        $userPass = $row['password'];
    }

?>
 <div class="row">
        <div class="panel panel-info col-md-5" >
                <div class="panel-heading">
                    <h3 class="panel-title">Current Password:</h3>
                </div>
                <div class="panel-body">
                    <?php printf("<p>%s</p>", $userPass); ?>
                </div>

        </div>
        <div class="col-md-5">
            <form role="form" action="adminMenu.php?page=user" method="post">
              <div class="form-group">
                <label for="password">Password</label><?php echo "<span class='alert-danger' >".$passErr."</span>"; ?>
                <input type="password" class="form-control" name="password" id="password">
                    <p class="help-block">Minimal requirement of 8 or more characters.</p>
              </div>
                <div class="form-group">
              <button type="submit" class="btn btn-primary">Change Student Password</button>
                </div>
            </form>
        </div>
 </div>
<?php
 //Flush buffer
 ob_flush();
?>