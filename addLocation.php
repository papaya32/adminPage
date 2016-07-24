<?PHP
require_once("/home/papaya/.access/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("access/login.php");
    exit;
}
?>
<!DOCTYPE html> <html>

<head>
  <title>PapI 2016</title>
  <link href="style/tester.css" rel="stylesheet">
</head>

<nav id="nav01"></nav>

<body>

  <div id="main">
  <h1 style="visibility:hidden" id="locationConfirm">New Location Added!</h1>
  <h1 style="visibility:hidden" id="locationFail">Failed to Add Location!</h1>
  <a href='tester.php' class="button buttonGreen">Home</a>
  <a href='locations.php' class="button buttonGreen">Return to Locations</a>

<script>
  function locationFail() {
    document.getElementById("locationFail").style.visibility = "visible";
  }
  function locationConfirm() {
    document.getElementById("locationConfirm").style.visibility = "visible";
  }
</script>
<?php
$servername = "ha-records.cxdm8r7jhkbf.us-east-1.rds.amazonaws.com";
$username = "phpUser";
$password = "24518000phpUser";
$database = "ha_records";

$conn = new mysqli($servername, $username, $password, $database);

$name = $_POST["addLocation"];
$user_name = $fgmembersite->UserUserName();

if (strlen($name) <= 50)
{
  echo "<script>locationConfirm()</script>";
if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
}

$nameF = "'" . $_POST["addLocation"] . "',";
$user_nameF = "'" . $user_name . "'";

echo'  <table class="blank_table">
    <tr>
      <td>Location</td>
    </tr>
    <tr>
      <td>' . $_POST["addLocation"] . '</td>
    </tr>
  </table>';

$sql = "INSERT INTO locations (location_name, user_name) VALUES (" . $nameF . $user_nameF . ")";

$result = $conn->query($sql);

/* $old_path = getcwd();
chdir('/home/papaya');
$command = "sudo ./tester.sh \"$name\" \"$location\" \"$serial\" \"$type\" \"itemChange\"";
$output = shell_exec($command);
chdir($old_path); */
}
else
{
  echo "<script>locationFail()</script>";
}
?>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
