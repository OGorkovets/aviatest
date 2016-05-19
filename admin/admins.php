<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
    ob_start();

?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Accounts</title>
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css">  
    
  </head>
  <body>
    <?php
    
        $tbl_name="UserInfo"; // Table name 
    
        //Connect to the database
        require "../db.php";
    
        
	$dbh = new PDO("mysql:host=$hostname;
						dbname=aviatest_english", $username, $password);
	if(!$dbh){
		die("Connection failed: " .mysql_error());
	}
    
    ?>
    <h2>Admins accounts</h2>
    <div class="row">
        <div class="col-md-2" >
            <ul class="nav nav-pills nav-stacked">

            <?php
              // Nav buttons
              $options = array("list users" => "adminsList", "add" => "adminAdd", "delete" => "adminDelete", "change password" => "adminPassword");
              
              foreach ($options as $index => $detail) {
                echo "<li ";
                if ($_GET['nav'] == $detail){
                  echo "class='active' ";
                };
                echo "><a href='?page=admins&nav=".$detail."'>";
                echo ucwords($index);
                echo "</a></li>";
              }
            ?>
            </ul>
        </div>
        <div class="col-md-10">
            <!-- Page content goes here -->
            <?php
              if (isset($_GET['nav']))
              {
                $nav = $_GET['nav'];
              }else{
                $nav = "adminsList"; //Default
              }
              include ($nav.".php");
            ?>
        </div>
    </div>


    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
    
  </body>
</html>

<?php
 //Flush buffer
 ob_flush();
?>