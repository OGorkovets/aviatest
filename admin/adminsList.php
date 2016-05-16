<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
    ob_start();

?>

<!DOCTYPE html>
<html>
 

<?php

    //Connect to the database
    require "../db.php";

    try {
        $dbh = new PDO("mysql:host=$hostname;
                       dbname=aviation_aviation", $username, $password);
        //echo "Connected to database.";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>

<h2>List of Administrators:</h2>

 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT adminFirst, adminLast, email FROM AdminInfo ORDER BY adminLast, adminFirst";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    printf("<tr><td>%s</td>", $row['adminFirst']);
                    printf("<td>%s</td>", $row['adminLast']);
                    printf("<td>%s</td></tr>", $row['email']);
                }
            ?>
        </tbody>
    </table>
        

</html>

<?php
 //Flush buffer
 ob_flush();
?>