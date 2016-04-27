<?php

    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    
    $height = mysql_real_escape_string($_POST["data2"]);
    $weight = mysql_real_escape_string($_POST["data3"]);
    $lookatid = mysql_real_escape_string($_POST["data1"]);
    $blood_type = mysql_real_escape_string($_POST["data4"]);
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    $query = "INSERT INTO physical_history (date, patientID, height, weight, blood_type) VALUES (CURDATE(), ". $lookatid .", ". $height .", ". $weight .", '". $blood_type ."');";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
