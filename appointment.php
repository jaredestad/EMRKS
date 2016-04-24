<?php
	
$username = "xcao";
$password = "potatogo";
$database = "xcao";
$host = "mysqldev.aero.und.edu";
$connect = mysql_connect($host,$username,$password);
mysql_select_db($database, $connect);
$doctorID=$_COOKIE["doctorid"];
$query = "select appointmentID,patientID,date,time from appointment where doctorID=$doctorID";
$result = mysql_query($query);
echo "<!DOCTYPE html>
<html>
 <head>
  <title>information</title>
  <link href=\"Site.css\" rel=\"stylesheet\">
 </head>";

 echo"<body>
  <nav id=\"nav01\"></nav>
  <div id=\"main\">
   <h1>welcome</h1>
<div id=\"id01\"></div>";

	echo "<form action='cancelappointment.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td> </td>";
	echo "<td>appointmentID</td>";
	echo "<td>patientID</td>";
	echo "<td>date</td>";
	echo "<td>time</td></tr>";
	while ($item = mysql_fetch_array($result)) {
		echo "<tr>";
		$appointmentID=$item[appointmentID];
		$patientID = $item[patientID];
		$date = $item[date];
		$time =$item[time];
		echo "<td><input type='radio' name='1' value='$appointmentID'></td>";
		echo "<td>$appointmentID</td>";
		echo "<td><a href='patientinformation.php?id=$patientID'>$patientID</a></td>";
		echo "<td>$date</td>";
		echo "<td>$time</td></tr>";
    }
	echo "</table>";
	echo "<input type='submit' name='act' value='cancel appointment'>";
	echo "</form>";
	mysql_close();

 echo" <td align=\"center\" colspan=\"2\">
  </td>
 </tr>
 <footer id=\"foot01\"></footer>
  </div>
  <script src=\"Scriptdoctor.js\"></script>
 </body>
</html>";
?>