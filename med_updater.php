<?php

    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    
    $symptom = mysql_real_escape_string($_POST["data2"]);
    $treatment = mysql_real_escape_string($_POST["data3"]);
    $id = mysql_real_escape_string($_POST["data1"]);
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    $query = "UPDATE medical_history SET treatment='". $treatment ."', symptom ='". $symptom ."' WHERE histID = ". $id .";";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
