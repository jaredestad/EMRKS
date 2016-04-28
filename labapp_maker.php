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
    $testerID = mysql_real_escape_string($_POST["data1"]);
    $patID = mysql_real_escape_string($_POST["data4"]);
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    //may need to make this work for lab tester
    $query = "INSERT INTO test_appointment (time, date, labtesterID, patientID) VALUES ('". $time ."', '". $date ."', ". $testerID .", ". $patID .");";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
