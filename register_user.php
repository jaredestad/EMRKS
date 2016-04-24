<?php
    $servername = "";
    $username = "";
    $password = "";
    
    
    $conn = mysql_connect($servername, $username, $password);
    if(! $conn)
    {
        die('Could not connect' . mysql_error());
    }
    
    $info = $_POST["user_info"];
    $account_type = mysql_real_escape_string( $_POST["account_type"] );
    
    parse_str($info, $info_output);
    $info_array = array_values($info_output);
    
    
    mysql_select_db('');
    mysql_query("SET NAMES utf8");
    
    
    $check_username_query = "SELECT username FROM doctor, patient, nurse, receptionist, admin, labtester WHERE username = '" . mysql_real_escape_string( $info_output["username"]);
    $prev_username = mysql_query($check_username_query, $conn);
    
    if(mysqli_num_rows($prev_username) > 0)
    {
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
        
        $sql2 = "SELECT ". $account_type ."ID, Fname, Lname FROM ". $account_type ." WHERE username = ". mysql_real_escape_string($info_output["username"]) .";";
        
        $id_query = mysql_query($sql2, $conn);
        
        while(($row = mysql_fetch_assoc($id_query)) != null)
        {
            
        }
        
        if(! $result || !$id_query) {
            die('Could not work: ' . mysql_error());
        }
        else
        {
            session_start();
            $_SESSION["userID"] = $row[$account_type ."ID"];
            $_SESSION["typeofuser"] = $account_type;
            $_SESSION["Fname"] = $row["Fname"];
            $_SESSION["Lname"] = $row["Lname"];
            header("Location: home.php");
            die();
        }
        
         echo "true";
        
    }
    
    mysql_close($conn);
    
    
    ?>
