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
        
        
        
        
        
        
        echo "<!DOCTYPE html>
        <html>
        <title>EMRKS-Home</title>
        <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html\"/>
            <meta charset=\"utf-8\"/>
            <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\">
            <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js\"></script>
            <script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>
            <link href=\"./navbar.css\" rel=\"stylesheet\">
            <link href=\"./input.css\" rel=\"stylesheet\">
        </head>";
        
        echo"<body>
        <!-- navbar section -->
        <div class=\"navbar\">
            <ul>
                <a style=\"font-size: 20px; font-weight: bold;\" href=\"#\">EMRKS</a>";
    ?>
                <li><a href="edit_information.php">Edit Information</a></li>

<?php if($_SESSION["typeofuser"] == "patient")
    {
                echo "<li><a href=\"makeappointment.php\">Book Appointment</a></li>";
                echo "<li><a href=\"viewap\">Search For Doctor</a></li>";
                echo "<li><a href='view_personal_information.php?id=". base64_encode($_SESSION["userID"]) ."&type=". base64_encode($_SESSION["typeofuser"]) ."'>My Records</a></li>";
                echo "<li><a href=\"appointment.php\">My Appointments</a></li>";
    }
?>
<?php if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "admin" || $_SESSION["typeofuser"] == "receptionist") : ?>
                <li><a href="appointment.php">View Appointments</a></li>
                <li><a href="labtest_appointment.php">View Lab Tests</a></li>
<?php endif; ?>
<?php if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "admin" || $_SESSION["typeofuser"] == "receptionist") : ?>
                <li><a href="viewap">Search For Patient</a></li>
<?php endif; ?>

<?php
        echo "</ul>
        </div>
        <div style=\"margin-top: -60px; margin-left: 1200px;\">
        <a href=\"logout.php\" style=\"color: white;\">Logout</a>
        </div>";
    
        echo "<h1 style=\"margin-left: 200px; color: white;\">Welcome ". $_SESSION["Fname"] ." ". $_SESSION["Lname"] ."</h1>";
        
        
        echo "
        </body>
        </html>";
    
    }
?>