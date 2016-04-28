<?php
    session_start();
    
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
            
            if($_SESSION["typeofuser"] == "doctor")
            {
                $sql = "Select appointmentID, patientID, date, time, doctorID FROM appointment WHERE doctorID = '". $_SESSION["userID"] ."' ORDER BY date, time DESC;";
            }
            else if($_SESSION["typeofuser"] == "patient")
            {
                $sql = "Select appointmentID, patientID, date, time, doctorID FROM appointment WHERE patientID = '". $_SESSION["userID"] ."' ORDER BY date, time DESC;";
            }
            else
            {
                $sql = "Select appointmentID, patientID, date, time, doctorID FROM appointment ORDER BY date, time DESC;";
            }
            
            
            $result = mysql_query($sql);
            if(! $result) {
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
        
        
    echo "<div class=\"well welldiv\" style=\"width: 300px;\">";
    echo "<div style=\"width: 300px; margin-left: 40px;\">";
    echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Appointments</span>";
    echo "<br>";
    echo "<table>";
    
    echo "<thead>";
    echo "<td>ID</td>";
    echo "<td>Patient</td>";
    echo "<td>Date</td>";
    echo "<td>Time</td>";
    echo "<td>Doctor</td>";
    if($_SESSION["typeofuser"] != "labtester")
    {
    echo "<td> </td>";
    }
    echo "</thead>";
    
    
    if(mysql_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_array($result)) {
            
            $appID = $row["appointmentID"];
            $patID = $row["patientID"];
            $date = $row["date"];
            $time = $row["time"];
            $docID = $row["doctorID"];
            
            
            $sql2 = "SELECT Fname, Lname FROM patient WHERE patientID = '". $patID ."';";
            $result2 = mysql_query($sql2);
            if(! $result2) {
                die('Could not work: ' . mysql_error());
            }
            if(mysql_num_rows($result2) > 0)
            {
                while ($row2= mysql_fetch_array($result2)){
                    
                    $name = $row2["Fname"] ." ". $row2["Lname"];
                }
            }
            
            
            
            $sql3 = "SELECT Fname, Lname FROM doctor WHERE doctorID = '". $docID ."';";
            $result3 = mysql_query($sql3);
            if(! $result3) {
                die('Could not work: ' . mysql_error());
            }
            if(mysql_num_rows($result3) > 0)
            {
                while ($row3 = mysql_fetch_array($result3)) {
                    $name2 = $row3["Fname"] ." ". $row3["Lname"];
                }
            }
            
            echo "<tr>";
            echo "<td>$appID</td>";
            echo "<td><a href='view_personal_information.php?id=". base64_encode($patID) ."&type=". base64_encode(patient) ."'>$name</td>";
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td><a href='view_personal_information.php?id=". base64_encode($docID) ."&type=". base64_encode(doctor) ."'>$name2</td>";
            if($_SESSION["typeofuser"] != "labtester")
            {
            echo "<td><span id='$appID' class=\"remove_regapp\" style=\"margin-top: 5px;\">&#10006</span></td>";
            }
            echo "<input value='appointment' id='hidden_type' style='display: none;'></input>";
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