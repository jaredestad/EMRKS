<?php
    session_start();
    
    $lookatid = mysql_escape_string( base64_decode($_GET["id"]));
    $lookattype = mysql_escape_string( base64_decode($_GET["type"]));
    
    
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
            
                $sql = "SELECT Fname, Lname, Mname, SSN , age, gender, phone_number, email, address, city, state, zipcode FROM ". $lookattype ." WHERE ". $lookattype ."ID = '". $lookatid ."';";
            
            
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
        
        
    echo "<div class=\"well welldiv\">";
    echo "<div style=\"overflow: hidden; margin-left: 10px; margin-right: auto;\">";
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
        }
    }
    echo "<div style='float: left;'>";
    if($lookattype == "patient")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Patient Information</span>";
    }
    else if($lookattype == "doctor")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Doctor Information</span>";
    }
    else if($lookattype == "nurse")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Nurse Information</span>";
    }
    else if($lookattype == "labtester")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Lab Tester Information</span>";
    }
    else if($lookattype == "receptionist")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Receptionist Information</span>";
    }
    else if($lookattype == "admin")
    {
        echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Administrator Information</span>";
    }
    echo "<br>";
    echo "<p><b>First Name: </b>$Fname</p>";
    echo "<p><b>Last Name: </b>$Lname</p>";
    echo "<p><b>Middle Name: </b>$Mname</p>";
    echo "<p><b>Age: </b>$age</p>";
    echo "<p><b>Gender: </b>$gender</p>";
    ?>
<?php if($_SESSION["typeofuser"] == "receptionist"){
    echo "<p><b>SSN: </b>$ssn</p>";
echo "<p><b>Phone: </b>$phone</p>";
echo "<p><b>Email: </b>$email</p>";
echo "<p><b>Address: </b>$address</p>";
echo "<p><b>City: </b>$city</p>";
echo "<p><b>State: </b>$state</p>";
echo "<p><b>ZIP: </b>$zip</p>";
}
if($_SESSION["typeofuser"] == "patient" || $_SESSION["typeofuser"] == "receptionist")
    {
    if($lookattype == "patient")
    {
        $iquery = "SELECT * FROM insurance WHERE patientID = '". $lookatid ."';";
        $result4 = mysql_query($iquery);
        if(! $result4) {
            die('Could not work: ' . mysql_error());
        }
        if(mysql_num_rows($result4) > 0)
        {
            while ($row4 = mysql_fetch_assoc($result4)){
                $card = $row4["card_number"];
                $company = $row4["company_name"];
                $co_num = $row4["company_phone"];
            }
           echo "<span style=\"margin-left: 0px; font-weight: bold; font-size: 18px;\">Insurance Information</span>";
            echo "<p><b>Company: </b>$company</p>";
            echo "<p><b>Company No: </b>$co_num</p>";
            echo "<p><b>Card No: </b>$card</p>";
            
        }
        
    }
    }
    echo "</div>";
    
    if($lookattype == "patient")
    {
    $sql2 = "SELECT allergy FROM allergies WHERE ". $lookattype ."ID = '". $lookatid ."';";
    
    
    $result2 = mysql_query($sql2);
    if(! $result2) {
        die('Could not work: ' . mysql_error());
    }
    
    if(mysql_num_rows($result2) > 0)
    {
    echo "<div style='float: left; width: 150px; margin-left: 0px;'>";
        echo "<span style='margin-left: 30px; font-weight: bold; font-size: 18px'>Allergies</span>";
    echo "<ul>";
        
     while ($row2 = mysql_fetch_assoc($result2))
     {
         $allergy = $row2["allergy"];
         echo "<li>$allergy</li>";
    
     }
    echo "</ul>";
    echo "</div>";
    
    }
    
    echo "<div style='margin-top: 5px; margin-left: 180px;'>";
    if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse" || $_SESSION["typeofuser"] == "patient")
    {
    echo "<input type='text' id='allergy_input' placeholder='Allergy'>";
    echo "<br>";
    echo "<button style='margin-top: 5px;' id='add_allergy'>Add</button>";
    }
    echo "<input value=$lookatid id='id_getter' style='display: none;'></input>";
        echo "<br>";
        if($_SESSION["typeofuser"] == "doctor" || $_SESSION["typeofuser"] == "nurse"){
    echo "<button style='margin-top: 5px;' id='make_labapp' onclick=\"location.href='make_labtestapp.php?id=". base64_encode($lookatid) ."'\">Make Lab Test Appointment</button>";
        }
    echo "</div>";
    
    }
    
    echo "</div>";
    
    echo "<div>";
    if($lookattype == "patient")
    {
        echo "<button onclick=\"location.href='./view_medhist.php?id=". base64_encode($lookatid) ."'\" id=\"medhist_button\" class=\"margins\">Medical Records</button>";
        echo "<button onclick=\"location.href='./view_phyhist.php?id=". base64_encode($lookatid) ."'\" id=\"physhist_button\" class=\"margins\">Physical Records</button>";
        echo "<button onclick=\"location.href='./prescribe.php?id=". base64_encode($lookatid) ."'\" id=\"prescriptions_button\" class=\"margins\">Prescriptions</button>";
        echo "<button onclick=\"location.href='./view_labtests.php?id=". base64_encode($lookatid) ."'\" id=\"labtests_button\" class=\"margins\">Lab Tests</button>";
    }
    echo "</div>";
    echo "</div>";
    
    
            mysql_close();
        }






?>
</body>
</html>