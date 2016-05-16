<?php
  //*** Start a session
  session_start();
  //*** Start the buffer
ob_start();
 if(empty($_SESSION["myemail"])){
    session_unset();
    header("location:index.php");
 }
?>

<h2>List of Cards:</h2>
<br>

<!--  Shows existing Sections added -->
 <table width="100%" class="display" id="table" cellspacing="0">
        <thead>
            <tr>
                <th>Section</th>
                <th>Term</th>
                <th>Sentence Example</th>
                <th>Image Directory</th>
                <th>Audio Directory</th>
            </tr>
        </thead>
 
        <tfoot>
             <tr>
                <th>Section</th>
                <th>Term</th>
                <th>Sentence Example</th>
                <th>Image Directory</th>
                <th>Audio Directory</th>
            </tr>
        </tfoot>
        <tbody>
            
            <?php

                //Display contacts from database
                $sql = "SELECT secid, term, sentence, img, audio FROM Cards ORDER BY secid";
                $result = $dbh->query($sql);
                foreach ($result as $row) {
                    printf("<tr><td>%s</td>", $row['secid']);
                    printf("<td>%s</td>", $row['term']);
                    printf("<td>%s</td>", $row['sentence']);
                    printf("<td>%s</td>", $row['img']);
                    printf("<td>%s</td></tr>", $row['audio']);

                }
            ?>
        </tbody>
    </table>

<?php
 //Flush buffer
 ob_flush();
?>