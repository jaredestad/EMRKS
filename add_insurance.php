<?php

    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    $phone = mysql_real_escape_string($_POST["data3"]);
    $company = mysql_real_escape_string($_POST["data2"]);
    $card = mysql_real_escape_string($_POST["data1"]);
    $lookatid = $_POST["data4"];
    
    
    if(! $connect)
    {
        die('Could not connect' . mysql_error());
    }
    
    $query = "SELECT * FROM insurance WHERE patientID = '". $lookatid ."';";
    
    
    $result = mysql_query($query, $connect);
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
    
    
    if(mysql_num_rows($result) > 0)
    {
        $sql = "UPDATE insurance SET card_number = ". $card .", company_name = '". $company ."', company_phone =". $phone ." WHERE patientID = '". $lookatid ."';";
    }
    else
    {
        $sql = "INSERT INTO insurance (patientID, company_name, company_phone, card_number) VALUES (". $lookatid .", '". $company ."', ". $phone .", ". $card .");";
    }
    $result2 = mysql_query($sql, $connect);
    
    if(! $result2) {
        die('Could not work: ' . mysql_error());
    }
    
    echo "true";
    
    mysql_close();
    

?>
