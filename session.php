<?php
/**
   * @author Oleksandr, Axum, Ramona
   * @version 2.0
   * @filename session.php
   * this file is used to create new session when user logs in
   */
//Start a session
session_start();
// Start the buffer
ob_start();

    /*if(empty($_SESSION["myusername"])){
    session_unset();
    header("location:index.html");
    }*/
    if(empty($_SESSION["loggedin"])){
      session_unset();
      header("location:index.html");
    }

?>