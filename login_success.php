<?php
 session_start();
 ob_start();
 if(empty($_SESSION["myemail"])){
    header("location:adminIndex.php");
 }
 ?>

 <html>
 <body>
 Login Successful
 </body>
 </html>
 <?php
 //Flush buffer
 ob_flush();
?>