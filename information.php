<?php
    
    $lookatid = mysql_escape_string( $_GET["id"] );
    $lookattype = mysql_escape_string( $_GET["type"]);
    
    /*
    if(!isset($_SESSION["userID"]) || !isset($_SESSION["typeofuser"]) ||)
    {
        echo "<script>setTimeout('location.href = \"login.html\";', 1500);</script>"; //http://stackoverflow.com/questions/18305258/display-message-before-redirect-to-other-page
        echo "<script type='text/javascript'>alert('You have been denied access to this page');</script>"; //http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
        die();
    }*/
    if(2==3)
    {
        
    }
    else
    {
        /*
        if( $_SESSION["typeofuser"] == "patient" && $lookattype == "patient")
        {
            echo "<script>setTimeout('location.href = \"login.html\";', 1500);</script>"; //http://stackoverflow.com/questions/18305258/display-message-before-redirect-to-other-page
            echo "<script type='text/javascript'>alert('You have been denied access to this page');</script>"; //http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
            die();
            
        }*/
        if(2==3)
        {
            
        }
        else
        {
            
            $username = "xcao";
            $password = "potatogo";
            $database = "xcao";
            $host = "mysqldev.aero.und.edu";
            //$connect = mysql_connect($host,$username,$password);
            //mysql_select_db($database, $connect);
            
            if( $_SESSION["typeofuser"] == "labtester")
            {
                $sql = "Select * FROM appointment WHERE testerID = '". $_SESSION["userID"] ."';";
            }
            else
            {
                $sql = "Select * FROM appointment WHERE doctorID = '". $_SESSION["userID"] ."';";//maybe dont use * because we are grabbing the password right now
            }
            
            
            //$result = mysql_query($sql);
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
    echo "<div class=\"well welldiv\">";
    echo "<div style=\"display: block; margin-left: 110px; margin-right: auto;\">";
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysql_fetch_array($result)) {
            /*
            if($_SESSION["userID"] == "labtester")
            {
                
            }
            else
            {
                
            }*/
            
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
        }
    }
    echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Patient Information</span>";
    echo "<br>";
    echo "<p><b>First Name: </b>$Fname</p>";
    echo "<p><b>Last Name: </b>$Lname</p>";
    echo "<p><b>Middle Name: </b>$Mname</p>";
    ?>
<?php if($_SESSION["typeofuser"] == "receptionist" || 2==2){

echo "<p><b>SSN: </b>$ssn</p>";
}?>
<?php
    echo "<p><b>Age: </b>$age</p>";
    echo "<p><b>Gender: </b>$gender</p>";
    ?>
<?php if($_SESSION["typeofuser"] == "receptionist" || 2==2){
echo "<p><b>Phone: </b>$phone</p>";
echo "<p><b>Email: </b>$email</p>";
echo "<p><b>Address: </b>$address</p>";
echo "<p><b>City: </b>$city</p>";
echo "<p><b>State: </b>$state</p>";
echo "<p><b>ZIP: </b>$zip</p>";
}
    ?>
<?php
    echo "</div>";
    echo "</div>";
    
    
            //mysql_close();
        }



    
    }



?>
</body>
</html>