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
            
            $sql = "SELECT Fname, Lname FROM patient WHERE patientID = '". $lookatid ."';";
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
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
    
    if(mysql_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_array($result)) {
            $name = $row["Fname"] ." ". $row["Lname"];
        }
        
    }
    
    echo "<div class=\"well welldiv\" style='width: 475px;'>";
    echo "<div class='reg-forms' style='width: 475px; margin-left: 40px;'>";
    echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Prescriptions for</span>";
    echo "<br>";
    echo "<a href='view_personal_information.php?id=". base64_encode($lookatid) ."&type=". base64_encode(patient) ."' style=\"margin-left: 0px; font-weight: bold; font-size: 18px; cursor: pointer;\">$name</a>";
    echo "<br>";
    if($_SESSION["typeofuser"] == "doctor")
    {
    echo "<input value=$lookatid id='id_getter' style='display: none;'></input>";
    echo "<input type='text' id='tradename' placeholder='Tradename'></input>";
    echo "<input type='text' id='quantity' placeholder='Quantity'></input>";
    
    echo "<button class=\"margins\" style=\"margin-top: 5px;\" id=\"confirm_prescriptionbutton\">Confirm</button>";
    }
    
    
    echo "<table>";
    
    echo "<thead>";
    echo "<td>ID</td>";
    echo "<td>Date</td>";
    echo "<td>Doctor</td>";
    echo "<td>Tradename</td>";
    echo "<td>Quantity</td>";
    if($_SESSION["typeofuser"] == "doctor")
    echo "<td> </td>";
    echo "</thead>";
    
    $sql2 = "SELECT * FROM prescription WHERE patientID = '". $lookatid ."' ORDER BY date DESC;";
    $result2 = mysql_query($sql2);
    if(! $result2) {
        die('Could not work: ' . mysql_error());
    }
    
    if(mysql_num_rows($result2) > 0)
    {
        while ($row2 = mysql_fetch_array($result2)) {
            
            $tradename = $row2["tradename"];
            $date = $row2["date"];
            $quantity = $row2["quantity"];
            $prescID = $row2["prescriptionID"];
            $docID = $row2["doctorID"];
            
            $sql3 = "SELECT Fname, Lname FROM doctor WHERE doctorID = '". $docID ."';";
            $result3 = mysql_query($sql3);
            if(! $result3) {
                die('Could not work: ' . mysql_error());
            }
            if(mysql_num_rows($result3) > 0)
            {
                while ($row3 = mysql_fetch_array($result3)) {
                    $name = $row3["Fname"] ." ". $row3["Lname"];
                }
            }
            
            echo "<tr>";
            echo "<td>$prescID</td>";
            echo "<td>$date</td>";
            echo "<td><a href='view_personal_information.php?id=". base64_encode($docID) ."&type=". base64_encode(doctor) ."'>$name</td>";
            echo "<td>$tradename</td>";
            echo "<td>$quantity</td>";
            if($_SESSION["typeofuser"] == "doctor")
            {
            echo "<td><span id='$prescID' class=\"remove_regapp\" style=\"margin-top: 5px;\">&#10006</span></td>";
            }
            echo "<input value='presrec' id='hidden_type' style='display: none;'></input>";
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