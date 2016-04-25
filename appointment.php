<?php
    
    if(!isset($_SESSION["userID"]) || !isset($_SESSION["typeofuser"]) ||)
    {
        echo "<script>setTimeout('location.href = \"login.html\";', 1500);</script>"; //http://stackoverflow.com/questions/18305258/display-message-before-redirect-to-other-page
        echo "<script type='text/javascript'>alert('You have been denied access to this page');</script>"; //http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
        die();
    }
    else
    {
        
        if( $_SESSION["typeofuser"] == "patient" )
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
            
            if( $_SESSION["typeofuser"] == "labtester")
            {
                $sql = "Select test_appointmentID, patientID, date, time, Fname, Lname FROM appointment WHERE testerID = '". $_SESSION["userID"] ."';";
            }
            else
            {
                $sql = "Select appointmentID, patientID, date, time, Fname, Lname FROM appointment WHERE doctorID = '". $_SESSION["userID"] ."';";
            }
            
            
            $result = mysql_query($sql);
            if(! $result) {
                die('Could not work: ' . mysql_error());
            }
            ?>
            <!DOCTYPE html>
                <title>EMRKS-Appointments</title>
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html"/>
                <meta charset="utf-8"/>
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                <script src="./basic_js.js" type="text/javascript"></script>
                <link href="./navbar.css" rel="stylesheet">
                <link href="./input.css" rel="stylesheet">
            </head>
            <body>
                <!-- navbar section -->
                <div class="navbar">
                    <ul>
                    <a style="font-size: 20px; font-weight: bold;" href="#">EMRKS</a>
                    <li><a href="editpage">Edit Information</a></li>

                <?php if($_SESSION["typeofuser"] == "patient") : ?>
                    <li><a href=\"bookpage\">Book Appointment</a></li>
                    <li><a href=\"viewap\">Search For Doctor</a></li>
                    <li><a href=\"viewap\">My Records</a></li>
                    <li><a href=\"viewap\">My Appointments</a></li>
                <?php endif; ?>
                <?php if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "admin" || $_SESSION["typeofuser"] == "receptionist") : ?>
                    <li><a href=\"viewap\">View Appointments</a></li>
                <?php endif; ?>
                <?php if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "admin" || $_SESSION["typeofuser"] == "receptionist") : ?>
                    <li><a href=\"viewap\">Search For Patient</a></li>
                <?php endif; ?>

                    </ul>
                </div>
                <div style="margin-top: -60px; margin-left: 1200px;">
                    <a href="logout.php" style="color: white;">Logout</a>
                </div>


<?php
        echo "<div class=\"well welldiv\" style=\"width: 30em; margin-left: auto; margin-right: auto;\">";
        echo "<table>";
        echo "<thead>";
        echo "<td>Checkbox</td>";
        echo "<td>ID</td>";
        echo "<td>Patient</td>";
        echo "<td>Date</td>";
        echo "<td>Time</td>";
        echo "</thead>";
        echo "<tr>";
        if(mysqli_num_rows($result) > 0)
        {
        while ($row = mysql_fetch_array($result)) {
            if($_SESSION["userID"] == "labtester")
            {
                $appID = $row["appointmentID"];
                $patID = $row["patientID"];
                $name = $row["Fname"] ." ". $row["Lname"];
                $date = $row["date"];
                $time = $row["time"];
            }
            else
            {
                $appID = $row["test_appointmentID"];
                $patID = $row["patientID"];
                $name = $row["Fname"] ." ". $row["Lname"];
                $date = $row["date"];
                $time = $row["time"];
            }
            echo "<td><input type='checkbox' value='$appID' class='tcheck'></td>";
            echo "<td>$appID</td>";
            echo "<td><a href='information.php?id=$patID&type=\"patient\"'>$name</td>";
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "</tr";
            }
        }
        echo "</table>";
        echo "<button id=\"delete_button\" style=\"margin-top: 5px;\">Delete</button>";
        echo "</div>";
    
    
            mysql_close();
        }



    
    }



?>
</body>
</html>