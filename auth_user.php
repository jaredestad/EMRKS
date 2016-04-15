<?php
    $servername = "";
    $username = "";
    $password = "";
    
    
    $conn = mysql_connect($servername, $username, $password);
    if(! $conn)
    {
        die('Could not connect' . mysql_error());
    }
    
    $username = mysql_real_escape_string( $_POST["username"] );
    $password = mysql_real_escape_string( $_POST["password"] );
    
    $sql = "SELECT id FROM users WHERE username = '" . $username . "' AND password = '" . $password . "';";
    
    
    mysql_select_db('');
    mysql_query("SET NAMES utf8");
    $result = mysql_query($sql, $conn);
    
    
    if(! $result) {
        die('Could not work: ' . mysql_error());
    }
   
    
    if(mysqli_num_rows($result) > 0)
    {
        echo "true";
    }
    else{
        echo "false";
    }
    
    
    mysql_close($conn);
    
    
    ?>
