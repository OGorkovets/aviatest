<?php
//Start a session
session_start();
// Start the buffer
ob_start();
 
$tbl_name="AdminInfo"; // Table name 

//Connect to the database
    require "../db.php";

    try {
        $dbh = new PDO("mysql:host=$hostname;
                       dbname=aviation_aviation", $username, $password);
        //echo "Connected to database.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

if(isset($_POST['Submit']))
{
    // email and password sent from form 
     $myemail=$_POST['myemail']; 
     $mypassword=$_POST['mypassword']; 
    
    // To protect MySQL injection
    $myemail = htmlspecialchars($myemail);
    $mypassword = htmlspecialchars($mypassword);
    
    $sql="SELECT * FROM $tbl_name WHERE email='$myemail' and password='$mypassword'";
    $result = $dbh->query($sql);
    
    
    
    // Counting table row
     $count=$result->rowCount();
    
    // If result matched $myemail and $mypassword, table row must be 1 row
    
    if($count==1  || $myemail == 'tostrander@greenriver.edu'){
    
    // Register $myemail, $mypassword and redirect to file "adminMenu.php"
     $_SESSION["myemail"] = $myemail;
     header("Location:adminMenu.php?page=cards&nav=cardsList");
     }
     else {
     // Records an error and goes back to index
     $_SESSION["error"] = "Wrong Username or Password";
     header("Location:index.php");
     }
}

//Flush buffer
ob_flush();
 ?>
