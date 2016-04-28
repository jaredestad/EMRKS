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
            
            if($_SESSION["typeofuser"] == "labtester")
            {
                $sql = "Select appointmentID, patientID, date, time FROM test_appointment WHERE labtesterID = '". $_SESSION["userID"] ."' ORDER BY date, time;";
            }
            else
            {
                $sql = "Select appointmentID, patientID, date, time FROM test_appointment;";
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
    echo "<div class=\"well welldiv\" style=\"width: 300px;\">";
    echo "<div style=\"width: 300px; margin-left: 40px;\">";
    echo "<table>";
    
    echo "<thead>";
    echo "<td>ID</td>";
    echo "<td>Patient</td>";
    echo "<td>Date</td>";
    echo "<td>Time</td>";
    echo "<td> </td>";
    echo "</thead>";
    
    
    if(mysql_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_array($result)) {
            
            $appID = $row["appointmentID"];
            $patID = $row["patientID"];
            $date = $row["date"];
            $time = $row["time"];
            
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
            
            
            echo "<tr>";
            echo "<td>$appID</td>";
            echo "<td><a href='view_personal_information.php?id=$patID&type=\"patient\"'>$name</td>";
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td><span id='$appID' class=\"remove_testapp\" style=\"margin-top: 5px;\">&#10006</span></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    
    echo "</div>";
    echo "</div>";
    
    
    mysql_close();
    }
    
    
    
    
    }
    
    
    
    ?>
</body>
</html>