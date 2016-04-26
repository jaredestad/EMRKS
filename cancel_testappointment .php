<?php
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    $appID = $_POST["data1"];
    
    
    $query = "DELETE FROM test_appointment WHERE appointmentID = ". $appID .";";
    $result = mysql_query($query);
    mysql_close();
    

?>
