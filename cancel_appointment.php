<?php
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    $appID = $_POST["data1"];
    $type = $_POST["data2"];
    
    if($type == "appointment")
    {
        $query = "DELETE FROM appointment WHERE appointmentID = ". $appID .";";
    }
    else if($type == "lab_appointment")
    {
        $query = "DELETE FROM test_appointment WHERE appointmentID = ". $appID .";";
    }
    else if($type == "labrec")
    {
        $query = "DELETE FROM labtest WHERE labtestID = ". $appID .";";
    }
    else if($type == "medrec")
    {
        $query = "DELETE FROM medical_history WHERE histID = ". $appID .";";
    }
    else if($type == "phyrec")
    {
        $query = "DELETE FROM physical_history WHERE histID = ". $appID .";";
    }
    else if($type == "presrec")
    {
        $query = "DELETE FROM prescription WHERE prescriptionID = ". $appID .";";
    }
    $result = mysql_query($query);
    mysql_close();
    

?>
