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
            
            $sql = "SELECT * From ". $_SESSION["typeofuser"] ." WHERE ". $_SESSION["typeofuser"] ."ID = ". $_SESSION["userID"] .";";
            
            
            $result = mysql_query($sql);
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
    echo "<div style=\"display: block; margin-left: 110px; margin-right: auto; width: 100px;\">";
    
    if(mysql_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_array($result)) {
            
            $Fname = $row["Fname"];
            $Lname = $row["Lname"];
            $Mname = $row["Mname"];
            $ssn = $row["SSN"];
            $age = $row["age"];
            $gender = $row["gender"];
            $phone = $row["phone_number"];
            $email = $row["email"];
            $address = $row["address"];
            $city = $row["city"];
            $zip = $row["zipcode"];
            $state = $row["state"];
            $pass = $row["password"];
        }
    }
    echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Edit Information</span>";
    echo "<br>";
    echo "<form id=\"edit_info\">";
    echo "<input type=\"text\" name=\"Fname\" value=\"$Fname\" placeholder=\"Firstname\">";
    echo "<input type=\"text\" name=\"Lname\" value=\"$Lname\" placeholder=\"Lastname\">";
    echo "<input type=\"text\" name=\"Mname\" value=\"$Mname\" placeholder=\"Middlename\">";
    echo "<input type=\"text\" name=\"ssn\" value=\"$ssn\" placeholder=\"SSN\">";
    echo "<input type=\"text\" name=\"age\" value=\"$age\" placeholder=\"Age\">";
    echo "<input type=\"text\" name=\"gender\" value=\"$gender\" placeholder=\"Gender\">";
    echo "<input type=\"text\" name=\"phone\" value=\"$phone\" placeholder=\"Phone Number\">";
    echo "<input type=\"text\" name=\"email\" value=\"$email\" placeholder=\"Email\">";
    echo "<input type=\"text\" name=\"address\" value=\"$address\" placeholder=\"Address\">";
    echo "<input type=\"text\" name=\"city\" value=\"$city\" placeholder=\"City\">";
    echo "<input type=\"text\" name=\"state\" value=\"$state\" placeholder=\"State\">";
    echo "<input type=\"text\" name=\"zip\" value=\"$zip\" placeholder=\"Zip Code\">";
    echo "<input type=\"password\" name=\"pass\" value=\"$pass\" placeholder=\"Password\">";
    echo "</form>";
    echo "<button id=\"save_info\" style=\"margin-top: 5px;\" >Save</button>";
    echo "</div>";
    echo "</div>";
    mysql_close();
    }
?>
</body>
</html>