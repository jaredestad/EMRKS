<?php
    
    $username = "xcao";
    $password = "potatogo";
    $database = "xcao";
    $host = "mysqldev.aero.und.edu";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    $array = $_POST["thoseChecked"];
    
    
    foreach($array as $appID)
    {
        if($_SESSION["userID"] == "labtester")
        {
            $query = "DELETE FROM test_appointment WHERE test_appointmentID = $appID";
        }
        else{
            $query = "DELETE FROM appointment WHERE appointmentID = $appID";
        }
    }
    $result = mysql_query($query);
    mysql_close();
    

?>
