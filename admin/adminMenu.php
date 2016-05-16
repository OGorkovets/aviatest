<?php
 session_start();
 ob_start();
 if(empty($_SESSION["myemail"])){
    session_unset();
    header("location:index.php");
 }
 ?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Menu</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
 <body>
  <!-- Main content area -->
    <div class="container">
      
      <!-- Navigation bar -->
      <div class="header">
        <div class="dropdown">
          <ul class="nav nav-pills">
                    <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
        
        <ul class="nav nav-pills pull-right">

        <?php
          // Nav buttons
          $options = array("cards", "sections","user","admins");
          foreach ($options as $option) {
            echo "<li ";
            if ($_GET['page'] == $option){
              echo "class='active' ";
            };
            echo "><a href='?page=".$option."&nav=".$option."List'>";
            echo ucwords($option);
            echo "</a></li>";
          }
        ?>
        </ul>
        <h3 class="text-muted">Administrator Menu</h3>
      </div> <!-- End nav bar -->
      <hr>
      
      <!-- Page content goes here -->
      <?php
        if (isset($_GET['page']))
        {
          $page = $_GET['page'];
          $nav = $page."List";
        }else{
          $page = "cards";//Default
          $nav ="cardsList";
        }
        include ($page.".php");
      ?>
      
      <!-- Footer -->
      <hr>
      <footer>
        <p><a href="../index.html">Student Page</a></p>
      </footer>
      
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            "scrollY":  "400px",
            "scrollCollapse": true,
            "paging": false
        } );
    });

</script>
 </body>
 </html>
 <?php
 //Flush buffer
 ob_flush();
?>