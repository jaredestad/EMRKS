<?php
    session_start();
    
    $username = "root";
    $password = "password";
    $database = "xcao";
    $host = "localhost";
    
    
    $conn = mysql_connect($host, $username, $password);
    if(! $conn)
    {
        die('Could not connect' . mysql_error());
    }
    
    $info = $_POST["data1"];
    $account_type = mysql_real_escape_string( $_POST["data2"] );
    
    parse_str($info, $info_output);
    $info_array = array_values($info_output);
    
    
    
    
    
    mysql_select_db($database, $conn);
    mysql_query("SET NAMES utf8");
    
    $check_username_query = "(SELECT username FROM doctor WHERE username = '". mysql_real_escape_string($info_output["username"]) ."') UNION (SELECT username FROM patient WHERE username = '". mysql_real_escape_string($info_output["username"]) ."') UNION (SELECT username FROM admin WHERE username = '". mysql_real_escape_string($info_output["username"]) ."') UNION (SELECT username FROM nurse WHERE username = '". mysql_real_escape_string($info_output["username"]) ."') UNION (SELECT username FROM labtester WHERE username = '". mysql_real_escape_string($info_output["username"]) ."') UNION (SELECT username FROM receptionist WHERE username = '". mysql_real_escape_string($info_output["username"]) ."');";
    $prev_username = mysql_query($check_username_query, $conn);
    
    
  
    if(!$prev_username)
    {
        die('Could not connect' . mysql_error());
    }
    else
    {
        if(mysql_num_rows($prev_username)>0)
        {
            session_destroy();
            echo "bad_username";
        }
        else
        {
           
            $sql = "INSERT INTO " . $account_type . " (Fname, Lname, Mname, age, SSN, gender, phone_number, email, address, city, state, zipcode, username, password) VALUES (";
            
            for($x = 0; $x  < count($info_array); $x++)
            {
                
                $sql .= "'" . mysql_real_escape_string( $info_array[$x] ) . "'";
                
                if($x != count($info_array)-1)
                    $sql .= ", ";
            }
            
            $sql .= ");";
            
            $result = mysql_query($sql, $conn);
            
            $sql2 = "SELECT ". $account_type ."ID, Fname, Lname FROM ". $account_type ." WHERE username = '". mysql_real_escape_string($info_output["username"]) ."';";
            
            $id_query = mysql_query($sql2, $conn);
            
            
            if(! $result || !$id_query) {
                die('Could not work: ' . mysql_error());
            }
            else
            {
                
                while(($row = mysql_fetch_assoc($id_query)) != null)
                {
                    
                
                $_SESSION["userID"] = $row[$account_type ."ID"];
                $_SESSION["typeofuser"] = $account_type;
                $_SESSION["Fname"] = $row["Fname"];
                $_SESSION["Lname"] = $row["Lname"];
                }
            }
            
            echo "true";
            
        }
        
    }
    
    mysql_close($conn);
    
    
    ?>
