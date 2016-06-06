<?php
 /**
   * @edited by Oleksandr, Axum, Ramona
   * @version 2.0
   * @filename logout.php
   * this file is used to destroy session after user logs out 
   */
 session_start();
 // remove all session variables
 session_unset();
 // destroy session
 session_destroy();
 header("Location:index.html");
 ?>