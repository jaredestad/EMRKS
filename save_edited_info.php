<?php
    session_start();
    
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    $connect = mysql_connect($host,$username,$password);
    mysql_select_db($database, $connect);
    
    
    $array = $_POST["data1"];
    parse_str($array, $aout);
    
    $query = "UPDATE ". $_SESSION["typeofuser"] ." SET Fname ='". mysql_real_escape_string($aout["Fname"]) ."', Lname = '". mysql_real_escape_string($aout["Lname"]) ."', Mname = '". mysql_real_escape_string($aout["Mname"]) ."', age = '". mysql_real_escape_string($aout["age"]) ."', ssn = '". mysql_real_escape_string($aout["ssn"]) ."', gender = '". mysql_real_escape_string($aout["gender"]) ."', phone_number = '". mysql_real_escape_string($aout["phone"]) ."', email = '". mysql_real_escape_string($aout["email"]) ."', address = '". mysql_real_escape_string($aout["address"]) ."', city = '". mysql_real_escape_string($aout["city"]) ."', state = '". mysql_real_escape_string($aout["state"]) ."', zipcode = '". mysql_real_escape_string($aout["zip"]) ."', password = '". mysql_real_escape_string($aout["pass"]) ."' WHERE ". $_SESSION["typeofuser"] ."ID = '". $_SESSION["userID"] ."';";
    
    $result = mysql_query($query);
    mysql_close();
    

?>
