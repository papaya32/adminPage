<?PHP
require_once("/home/papaya/.access/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("access/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>PapI 2016</title>
  <link href="style/tester.css" rel="stylesheet">
</head>

<nav id="nav01"></nav>

<body>

  <div id="main">
  <h1>Location Manager</h1>
  <h2>Your locations
  <button class="button buttonGreen" onclick="addLocation()" class="button">Add Location</button>
  <button class="button buttonRed" onclick="removeLocation()" class="button">Remove Location</button>
  </h2>

  <h2 style="display:none" id="noLocations">No Locations Yet!</h2>

  <b><table style="display:none" id="addTitles" class="blank_table">
    <tr>
      <td id="title">Location</td>
      <td id="title">Devices</td>
    </tr>
  </table></b>
  <b><table style="display:none" id="removeTitles" class="blank_table">
    <tr>
      <td id="title">Location</td>
    </tr>
  </table></b>

  <form style="display:none" id="addLocation" action="addLocation.php" method="post">
    <input type="text" class="textbox" name="addLocation">
    <input type="submit" class="button" value="Submit">
  </form>

  <form style="display:none" id="removeLocation" action="removeLocation.php" method="post">
    <input type="text" class="textbox" name="removeLocation">
    <input type="submit" class="button" value="Submit">
  </form>

  <button id="clearButton" class="button"  style="display:none; background-color: #f44336;" onclick="clearLocations()" class="button">Clear</button>

  <script>
  function clearLocations() {
    document.getElementById("addTitles").style.display = "none";
    document.getElementById("removeTitles").style.display = "none";
    document.getElementById("clearButton").style.display = "none";
    document.getElementById("addLocation").style.display = "none";
    document.getElementById("removeLocation").style.display = "none";
    document.getElementById("noLocations").style.display = "none";
  }
  function addLocation() {
    clearLocations()
    document.getElementById("addTitles").style.display = "table";
    document.getElementById("clearButton").style.display = "initial";
    document.getElementById("addLocation").style.display = "initial";
  }
  function removeLocation() {
    clearLocations()
    document.getElementById("removeTitles").style.display = "table";
    document.getElementById("removeLocation").style.display = "initial";
    document.getElementById("clearButton").style.display = "initial";
  }
  function noLocations() {
    clearLocations()
    document.getElementById("noLocations").style.display = "initial";
  }
  </script>

<br></br>
<?php
$servername = "ha-records.cxdm8r7jhkbf.us-east-1.rds.amazonaws.com";
$username = "phpUser";
$password = "24518000phpUser";
$database = "ha_records";

if($_GET)
{
    if(isset($_GET['submitButton']))
    {
        submit();
    }
    elseif(isset($_GET['select']))
    {
        select();
    }
}
$conn = new mysqli($servername, $username, $password, $database);

$_SESSION['user_name'] = $fgmembersite->UserUserName();
$_SESSION['user_nameF'] = "'" . $_SESSION['user_name'] . "'";

if ($conn->connect_error)
{
        die("Connection failed: " .$conn->connect_error);
}
$_SESSION['sql'] = "SELECT location_name FROM locations WHERE user_name = " . $_SESSION['user_nameF'];

$_SESSION['result'] = $conn->query($_SESSION['sql']);

if ($_SESSION['result']->num_rows > 0)
{
        echo '<table class="dataTable" style="width: 75%">' . "\r\n" . '  <tr id="dataTableRow">' . "\r\n";
        echo '<td><b>Location</b></td><td><b>Devices</b></td></tr><tr>';
        while ($_SESSION['row'] = $_SESSION['result']->fetch_assoc())
        {
                echo "<td>" . $_SESSION['row']["location_name"] . "</td>" . "\r\n";
                echo "</tr>" . "\r\n";
        }
        echo "</table>" . "\r\n";
}
else
{
        echo '<script>' . 'noLocations();' . '</script>';
}
/* function submit()
{
	echo "submitting to sql";
	$name = $_POST['addName'];
	$location = $_POST['addLocation'];
	$serial = $_POST['addSerial'];
	$type = $_POST['addType'];
	//echo "name: " . $name . "\r\n";
	//$sql = "INSERT INTO devices (name, location, serial_num, type_num) VALUES ($name, $location, $serial, $type)";
	//$result = $conn->query($sql);
} */
?>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>