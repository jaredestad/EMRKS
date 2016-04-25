<?php

    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    
    $time = mysql_real_escape_string($_POST["data2"]);
    $date = mysql_real_escape_string($_POST["data3"]);
    $docID = mysql_real_escape_string($_POST["data1"]);
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    //may need to make this work for lab tester
    $query = "INSERT INTO appointment (time, date, doctorID, patientID) VALUES ('". $time ."', '". $date ."', ". $docID .", ". $_SESSION["userID"] .");";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
