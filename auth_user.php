<?php
    
    
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $database = "xcao";
    
    $conn = mysql_connect($servername, $username, $password);
    if(! $conn)
    {
        die('Could not connect' . mysql_error());
    }
    
    $username = mysql_real_escape_string( $_POST["data1"] );
    $password = mysql_real_escape_string( $_POST["data2"] );
    
    $sqldoctor = "SELECT doctorID, Fname, Lname FROM doctor WHERE username = '" . $username . "' AND password = '" . $password . "';";
    $sqlpatient = "SELECT patientID, Fname, Lname FROM patient WHERE username = '" . $username . "' AND password = '" . $password . "';";
    $sqlnurse = "SELECT nurseID, Fname, Lname FROM nurse WHERE username = '" . $username . "' AND password = '" . $password . "';";
    $sqlreceptionist = "SELECT receptionistID, Fname, Lname FROM receptionist WHERE username = '" . $username . "' AND password = '" . $password . "';";
    $sqladmin = "SELECT adminID, Fname, Lname FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "';";
    $sqltester = "SELECT labtesterID, Fname, Lname FROM labtester WHERE username = '" . $username . "' AND password = '" . $password . "';";
    
    
    mysql_select_db($database, $conn);
    mysql_query("SET NAMES utf8");
    $result_doctor = mysql_query($sqldoctor, $conn);
    $result_patient = mysql_query($sqlpatient, $conn);
    $result_nurse = mysql_query($sqlnurse, $conn);
    $result_receptionist = mysql_query($sqlreceptionist, $conn);
    $result_admin = mysql_query($sqladmin, $conn);
    $result_tester = mysql_query($sqltester, $conn);
    
    
    if(mysql_num_rows($result_doctor) > 0)
    {
        
        while(($row = mysql_fetch_assoc($result_doctor)) != null)
        {
            
        
        $_SESSION["userID"] = $row["doctorID"];
        $_SESSION["typeofuser"] = "doctor";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
            echo "true";
        }
    }
    else if(mysql_num_rows($result_patient) > 0 )
    {
        while(($row = mysql_fetch_assoc($result_patient)) != null)
        {
        
        $_SESSION["userID"] = $row["patientID"];
        $_SESSION["typeofuser"] = "patient";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
        
            /*
        echo $_SESSION["userID"] ."\n";
        echo $_SESSION["typeofuser"] ."\n";
        echo $_SESSION["Fname"] ."\n";
        echo $_SESSION["Lname"] ."\n";
            */
            echo "true";
        }
        
    }
    else if(mysql_num_rows($result_nurse) > 0 )
    {
        while(($row = mysql_fetch_assoc($result_nurse)) != null)
        {
        
        $_SESSION["userID"] = $row["nurseID"];
        $_SESSION["typeofuser"] = "nurse";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
            echo "true";
        }
    }
    else if(mysql_num_rows($result_receptionist) > 0 )
    {
        while(($row = mysql_fetch_assoc($result_receptionist)) != null)
        {
        
        $_SESSION["userID"] = $row["receptionistID"];
        $_SESSION["typeofuser"] = "receptionist";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
            echo "true";
        }
    }
    else if(mysql_num_rows($result_admin) > 0 )
    {
        while(($row = mysql_fetch_assoc($result_admin)) != null)
        {
        
        $_SESSION["userID"] = $row["adminID"];
        $_SESSION["typeofuser"] = "admin";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
            echo "true";
        }
    }
    else if(mysql_num_rows($result_tester) > 0 )
    {
        while(($row = mysql_fetch_assoc($result_tester)) != null)
        {
        
        $_SESSION["userID"] = $row["labtesterID"];
        $_SESSION["typeofuser"] = "labtester";
        $_SESSION["Fname"] = $row["Fname"];
        $_SESSION["Lname"] = $row["Lname"];
            
            echo $_SESSION["userID"];
            echo $_SESSION["typeofuser"];
            echo "true";
        }
    }
    else{
        session_destroy();
        echo "false";
    }
    
    
    mysql_close($conn);
    
    
    ?>
