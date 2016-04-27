<?php

    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    
    $tradename = mysql_real_escape_string($_POST["data2"]);
    $quantity = mysql_real_escape_string($_POST["data3"]);
    $lookatid = mysql_real_escape_string($_POST["data1"]);
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    //may need to make this work for lab tester
    $query = "INSERT INTO prescription (date, doctorID, patientID, quantity, tradename) VALUES (CURDATE(), ". $_SESSION["userID"] .", ". $lookatid .", ". $quantity .", '". $tradename ."');";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
