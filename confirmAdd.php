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
  <h1 style="visibility:hidden" id="deviceConfirm">New Device Added!</h1>
  <h1 style="visibility:hidden" id="deviceFail">Failed to Add Device!</h1>
  <a href='tester.php' class="button buttonGreen">Home</a>
  <a href='devices.php' class="button buttonGreen">Return to Devices</a>

<script>
  function deviceFail() {
    document.getElementById("deviceFail").style.visibility = "visible";
  }
  function deviceConfirm() {
    document.getElementById("deviceConfirm").style.visibility = "visible";
  }
</script>
<?php
$servername = "ha-records.cxdm8r7jhkbf.us-east-1.rds.amazonaws.com";
$username = "phpUser";
$password = "24518000phpUser";
$database = "ha_records";

$conn = new mysqli($servername, $username, $password, $database);

$name = $_POST["addName"];
$location = $_POST["addLocation"];
$serial = $_POST["addSerial"];
$type = $_POST["addType"];
$user_name = $fgmembersite->UserUserName();

if ((strlen($name) <= 50) && (strlen($location) <= 50) && (is_numeric($serial) == TRUE) && (is_numeric($type) == TRUE) && (strlen(strval($serial)) == 7) && (strlen(strval($type)) == 2))
{
  echo "<script>deviceConfirm()</script>";
if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
}

$nameF = "'" . $_POST["addName"] . "',";
$locationF = "'" . $_POST["addLocation"] . "',";
$serialF = "'" . $_POST["addSerial"] . "',";
$typeF = "'" . $_POST["addType"] . "',";
$user_nameF = "'" . $user_name . "'";

echo'  <table class="blank_table">
    <tr>
      <td>Name</td>
      <td>Location</td>
      <td>Serial Number</td>
      <td>Type Number</td>
    </tr>
    <tr>
      <td>' . $_POST["addName"] . '</td>
      <td>' . $_POST["addLocation"] . '</td>
      <td>' . $_POST["addSerial"] . '</td>
      <td>' . $_POST["addType"] . '</td>
    </tr>
  </table>';

$sql = "INSERT INTO devices (name, location, serial_num, type_num, user_name) VALUES (" . $nameF . $locationF . $serialF . $typeF . $user_nameF . ")";

$result = $conn->query($sql);

$old_path = getcwd();
chdir('/home/papaya');
$command = "sudo ./tester.sh \"$name\" \"$location\" \"$serial\" \"$type\" \"itemChange\"";
$output = shell_exec($command);
chdir($old_path);
}
else
{
  echo "<script>deviceFail()</script>";
}
?>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
