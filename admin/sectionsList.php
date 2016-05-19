<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
  ob_start();

    //Connect to the database
    require "../db.php";

    
	$dbh = new PDO("mysql:host=$hostname;
						dbname=aviatest_english", $username, $password);
	if(!$dbh){
		die("Connection failed: " .mysql_error());
	}
?>

<h2>Sections:</h2>
<br>

<!--  Shows existing Sections added -->
 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>Section</th>
                <th>Locked</th>
            </tr>
        </thead>
 
        <tfoot>
             <tr>
                <th>Section</th>
                <th>Locked</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT sectitle, locked FROM Section ORDER BY secid";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    printf("<tr><td>%s</td>", $row['sectitle']);
                    if ($row['locked'] == 0){
                        printf("<td>%s</td></tr>", "Unlocked");
                    }else if ($row['locked'] == 1){
                        printf("<td>%s</td></tr>", "Locked");
                    }
                    

                }
            ?>
        </tbody>
    </table>

<?php
 //Flush buffer
 ob_flush();
?>