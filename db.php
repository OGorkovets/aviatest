<?php
	/**
   * @author Oleksandr, Axum, Ramona
   * @version 2.0
   * @filename db.php
   * Connects to the required database using gven credentials
   * if connection failed reports an error
   */
	//given database credentials 
	$username = 'aviatest_admin';
    $password = 'admin';
    $hostname = 'localhost';
    
    
    $dbh = new PDO("mysql:host=$hostname;
						dbname=aviatest_english", $username, $password);
	
	//reports an error if connection failed
	if(!$dbh){
		die("Connection failed: " .mysql_error());
	}
?>