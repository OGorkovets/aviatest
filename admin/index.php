<?php
//Start a session
session_start();
// Start the buffer
ob_start();

// Need to fix. Trying to remove error session when refresh page.
/*if (!empty($_SESSION['error']) && !isset($_POST['Submit']))
{
   session_unset();
}*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    p.error {
        color:darkred;
    }
    </style>
</head>
<body>
    
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
   <form name="form1" method="post" action="checklogin.php">
    <td>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
    <td colspan="3"><strong>Member Login </strong></td>
    </tr>
    <tr>
    <td width="78">Email</td>
    <td width="6">:</td>
    <td width="294"><input name="myemail" type="text" id="myemail"></td>
    </tr>
    <tr>
    <td>Password</td>
    <td>:</td>
    <td><input name="mypassword" type="password" id="mypassword"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
    </table>
    <?php if (isset($_SESSION['error'])) echo "<p class='error text-center'>".$_SESSION["error"]."</p>"; ?>
    </td>
   </form>
    </tr>
    </table>
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
