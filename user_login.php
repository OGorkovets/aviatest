<?php
	// Start Session
	session_start();

	// Start the buffer
	ob_start();

	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	//Database
	require "db.php";

	$dbh = new PDO("mysql:host=$hostname;
						dbname=aviatest_english", $username, $password);
	if(!$dbh){
		die("Connection failed: " .mysql_error());
	}
	$tbl_name = "UserInfo";

	// Define $myusername and $mypassword from User Form
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];


	$sql="SELECT * FROM $tbl_name WHERE email='$myusername' and password='$mypassword'";
	//$sql = "SELECT * FROM $tbl_name WHERE password='$mypassword'";
	$result=$dbh->query($sql);

	//Test that the user name contains @mail.greenriver.edu
	$validUser = false;
	if(strpos($myusername,'@mail.greenriver.edu') !== false) {
		$validUser = true;
	}

	// Mysql_num_row is counting table row
	$count=$result->rowCount();

	// If result matched $myusername and $mypassword, table row must be 1 row

	if(($count==1 && $validUser)){

		// Register $myusername, $mypassword and redirect to file "user_login_success.php"
		/*$_SESSION["myusername"] = $myusername;
		$_SESSION["mypassword"]= $mypassword;*/
		$_SESSION["loggedin"] = 'true';
		header("location:main.php");
	}
	else {
		echo "<h3>Wrong Username or Password<h3>
			<a href='index.html'>Back to login</a>";
	}

	ob_end_flush();
?>
