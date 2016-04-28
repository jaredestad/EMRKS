<?php
    session_start();
    
    $lookatid = mysql_escape_string( base64_decode($_GET["id"]));
    
    if(!isset($_SESSION["userID"]) || !isset($_SESSION["typeofuser"]))
    {
        echo "<script>setTimeout('location.href = \"login.html\";', 1500);</script>"; //http://stackoverflow.com/questions/18305258/display-message-before-redirect-to-other-page
        echo "<script type='text/javascript'>alert('You have been denied access to this page');</script>"; //http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
        die();
    }
    else
    {
            
            $username = "root";
            $password = "password";
            $database = "xcao";
            $host = "localhost";
            $connect = mysql_connect($host,$username,$password);
            mysql_select_db($database, $connect);
        
        
        //$sql = "(SELECT * FROM medical_history AS m LEFT JOIN physical_history ON physical_history.date = m.date ORDER BY m.date) UNION (SELECT * FROM medical_history AS n RIGHT JOIN physical_history ON physical_history.date = n.date GROUP BY physical_history.date);";
        
            $sql = "SELECT date, result, labtestID FROM labtest WHERE patientID = '". $lookatid ."' ORDER BY date DESC;";
            $sql2 = "SELECT Fname, Lname FROM patient WHERE patientID ='". $lookatid ."';";
        
            $result = mysql_query($sql);
            $result2 = mysql_query($sql2);
            if(! $result || !$result2) {
                die('Could not work: ' . mysql_error());
            }
        
        
        
        
        echo "<!DOCTYPE html>
        <html>
        <title>EMRKS-Home</title>
        <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html\"/>
        <meta charset=\"utf-8\"/>
        <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js\"></script>
        <script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>
        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css\">
        <script src=\"./basic_js.js\" type=\"text/javascript\"></script>
        <link href=\"./navbar.css\" rel=\"stylesheet\">
        <link href=\"./input.css\" rel=\"stylesheet\">
        </head>";
        
        echo"<body>
        <!-- navbar section -->
        <div class=\"navbar\">
        <ul>
        <a style=\"font-size: 20px; font-weight: bold;\" href=\"#\">EMRKS</a>";
        echo "<li><a href=\"edit_information.php\">Edit Information</a></li>";
        
        if($_SESSION["typeofuser"] == "patient")
        {
            echo "<li><a href=\"makeappointment.php\">Book Appointment</a></li>";
            //echo "<li><a href=\"viewap\">Search For Doctor</a></li>";
            echo "<li><a href='view_personal_information.php?id=". base64_encode($_SESSION["userID"]) ."&type=". base64_encode($_SESSION["typeofuser"]) ."'>My Records</a></li>";
            echo "<li><a href=\"appointment.php\">My Appointments</a></li>";
            echo "<li><a href=\"test_appointment.php\">My Lab Tests</a></li>";
            echo "<li><a href=\"addedit_insurance.php\">Add/Edit Insurance Information</a></li>";
        }
        if($_SESSION["typeofuser"] != "patient") {
            echo "<li><a href=\"appointment.php\">View Appointments</a></li>";
            echo "<li><a href=\"test_appointment.php\">View Lab Tests</a></li>";
        }
        if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "admin" || $_SESSION["typeofuser"] == "receptionist") {
            echo "<li><a href=\"viewap\" style=\"display: none\">Search For Patient</a></li>";
        }
        echo "</ul>
        </div>
        <div style=\"margin-top: -60px; margin-left: 1200px;\">
        <a href=\"logout.php\" style=\"color: white;\">Logout</a>
        </div>";
        
    
    
    if(mysql_num_rows($result2) > 0)
    {
    while ($row2 = mysql_fetch_assoc($result2)){
        $name = $row2["Fname"] ." ". $row2["Lname"];
    }
    }
    
    echo "<div class=\"well welldiv\" id='maindiv' style='width: 300px;'>";
    echo "<div class='reg-forms' style='margin-left: 40px;'>";
    echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Lab Tests for</span>";
    echo "<br>";
    echo "<a href='view_personal_information.php?id=". base64_encode($lookatid) ."&type=". base64_encode(patient) ."' style=\"margin-left: 0px; font-weight: bold; font-size: 18px; cursor: pointer;\">$name</a>";
    echo "<br>";
    if($_SESSION["typeofuser"] == "labtester")
    {
    echo "<input value=$lookatid id='id_getter' style='display: none;'></input>";
    echo "<textarea type='text' id='result' placeholder='Results...' cols='35' rows='3'></textarea>";
    echo "<br>";
    echo "<button class=\"margins\" style=\"margin-top: 5px;\" id=\"confirm_labtestbutton\">Confirm</button>";
    }
    
    
    echo "<table>";
    
    echo "<thead>";
    echo "<td>Date</td>";
    echo "<td>Result</td>";
    if($_SESSION["typeofuser"] == "labtester")
    {
        echo "<td> </td>";
        echo "<td> </td>";
    }
    echo "</thead>";
    
    if(mysql_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_assoc($result)) {
            $date = $row["date"];
            $results = $row["result"];
            $labtestID = $row["labtestID"];
            
            
            echo "<tr id='$labtestID'>";
            echo "<td>$date</td>";
            echo "<td class='hidder' id='oresults'>$results</td>";
            echo "<td class='shower'><textarea id='cresults' placeholder='Results...' cols='40'>$results</textarea></td>";
            if($_SESSION["typeofuser"] == "labtester")
            {
                echo "<td class='hidder'><span id='$labtestID' class=\"edit_hist\"><i class=\"fa fa-pencil-square-o\"></i></span></td>";
                echo "<td class='shower'><span id='$labtestID' class=\"confirm_ledit\"><i class=\"fa fa-check\"></i></span></td>";
                echo "<td class='hidder'><span id='$labtestID' class=\"remove_regapp\" style=\"margin-top: 5px;\">&#10006</span></td>";
                echo "<td class='shower'><span id='$labtestID' class=\"cancel_ledit\" style=\"margin-top: 5px;\">&#10006</span></td>";
            }
            echo "<input value='labrec' id='hidden_type' style='display: none;'></input>";
            echo "</tr>";
        }
        
        
    }
    echo "</table>";
    
    echo "</div>";
    echo "</div>";
    
    
    mysql_close();
    }
    
    
    
    
    
    
    ?>
</body>
</html>