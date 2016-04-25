<?php
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    $time = mysql_string_escape($_POST["time"]);
    $date = mysql_string_escape($_POST["date"]);
    $docID = mysql_string_escape($_POST["docID"]);
    
    //may need to make this work for lab tester
    $query = "INSERT INTO appointment (time, date, doctorID, patientID) VALUES (". $time .", ". $date .", ". $docID .", ". $_SESSION["userID"] .");";
    
    $result = mysql_query($query);
    mysql_close();
    

?>
