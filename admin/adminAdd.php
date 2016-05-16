<?php
    //*** Start a session
    session_start();
    //*** Start the buffer
    ob_start();
    
    if(empty($_SESSION["myemail"])){
    session_unset();
    header("location:index.php");
 }
    // Function trims, removes slashes, and any additional html characters from parameter given and returns parameter
    function filterInput($info)
    {
        // If magic quotes not turned on add slashes
        if(!get_magic_quotes_gpc())
        {
            //Adds slashes
            $info = addslashes($info);
        }
        $info = strip_tags($info);
        $info = trim($info);
        $info = stripslashes($info);
        $info = htmlspecialchars($info);
            
            return $info;
        }

 
    //See if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Isset used for buttons
        //echo "Form was submitted.";
        
        //Flag variable for valid data
        $valid = true;     
    
    
        
        if (!empty($_POST['email'])){
            
            $email = $_POST['email'];
            // Sanitize email
            $emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($emailSanitized, FILTER_VALIDATE_EMAIL))
            {
                if(strpos($emailSanitized, "@greenriver.edu")=== false && strpos($emailSanitized, "@mail.greenriver.edu")=== false){
                    $emailErr="<p class='error'>Email address is not the correct Green River email.</p>";
                    echo $emailSanitized;
                    $valid = false;
                }
            }
            else
            {
                $emailErr = "<p class='error'>Email address invalid!</p>";
                $valid = false;
            }
           
        }   else {
            $emailErr = "<p class='error'>Email is required.</p>";
            $valid = false;
        
        }
        
        //First name
        if (!empty($_POST['adminFirst'])) {
            $first = $_POST['adminFirst'];
            
            if (!ctype_alpha($first)) {
                $firstErr = "<p class='error'>First name may only contain alphabetic characters.</p>";
                $valid = false;               
            }
        } else {
            $firstErr = "<p class='error'>Please enter first name.</p>";
            $valid = false;
        }

        //Last name
        if (!empty($_POST['adminLast'])) {
            $last = $_POST['adminLast'];
            if (!ctype_alpha($last)) {
                $lastErr = "<p class='error'>Last name may only contain alphabetic characters.</p>";
                $valid = false;               
            }            
        } else {
            $lastErr = "<p class='error'>Please enter last name.</p>";
            $valid = false;
        }
        
        //Password
        if (!empty($_POST['password'])) {
            $password= $_POST['password'];
            if (strlen($password) < 8){
                $passErr = "<p class='error'>Password needs to be a minimum of 8 characters long.</p>";
                $valid = false;
            }else {
            
            //$encryptedPwd = md5($password);
            }
        } else {
            $passErr = "<p class='error'>Password needs to be entered to add user.</p>";
            $valid = false;
        }
        

        //If the data is valid, write to DB
        
        if ($valid) {
           $sql = "INSERT INTO AdminInfo (adminFirst, adminLast, email, password)
            VALUES (:first, :last, :email, :password)";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':first', $first, PDO::PARAM_STR);
            $statement->bindParam(':last', $last, PDO::PARAM_STR);
            $statement->bindParam(':email', $emailSanitized, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->execute();
            echo "Sent to database";
        }
        
        
    }
    
?>
<h2>Add</h2>
<form role="form" action="adminMenu.php?page=admins&nav=adminAdd" method="post">
  <div class="form-group">
    <label for="adminFirst">First Name: <?php echo "<span class='alert-danger'>".$firstErr."</span>"; ?></label>
    <input type="text" class="form-control" name="adminFirst" id="adminFirst" value= '<?php echo $_POST['adminFirst']; ?>'>
  </div>
  <div class="form-group">
    <label for="adminLast">Last Name:</label><?php echo "<span class='alert-danger' >".$lastErr."</span>"; ?>
    <input type="text" class="form-control" name="adminLast" id="adminLast" value= '<?php echo $_POST['adminLast']; ?>'>
  </div>
  <div class="form-group">
    <label for="email">Email Address:</label><?php echo "<span class='alert-danger' >".$emailErr."</span>"; ?>
    <input type="email" class="form-control" name="email" id="email" value= '<?php echo $_POST['email']; ?>'>
  </div>
  <div class="form-group">
    <label for="password">Password</label><?php echo "<span class='alert-danger' >".$passErr."</span>"; ?>
    <input type="password" class="form-control" name="password" id="password" value= '<?php echo $_POST['password']; ?>'>
        <p class="help-block">Minimal requirement of 8 or more characters.</p>
  </div>
    <div class="form-group">
  <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>

<?php
 //Flush buffer
 ob_flush();
?>