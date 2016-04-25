<?php
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    $array = $_POST["thoseChecked"];
    
    
    foreach($array as $appID)
    {
        if($_SESSION["userID"] == "labtester")
        {
            $query = "DELETE FROM test_appointment WHERE appointmentID = $appID";
        }
        else{
            $query = "DELETE FROM appointment WHERE appointmentID = $appID";
        }
    }
    $result = mysql_query($query);
    mysql_close();
    

?>
