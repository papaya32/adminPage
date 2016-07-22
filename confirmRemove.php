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
  <h1 style="visibility:hidden" id="deviceConfirm">Device Removed!</h1>
  <h1 style="visibility:hidden" id="deviceFail">Failed to Remove Device!</h1>
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

$serial = $_POST["removeSerial"];
$user_name = $fgmembersite->UserUserName();

$conn = new mysqli($servername, $username, $password, $database);

if ((is_numeric($serial) == TRUE) && (strlen(strval($serial)) == 7))
{
if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
}

$serialF = "'" . $_POST["removeSerial"] . "'";
$user_nameF = "'" . $user_name . "'";

echo'  <table class="blank_table">
    <tr>
      <td>Serial Number</td>
    </tr>
    <tr>
      <td>' . $_POST["removeSerial"] . '</td>
    </tr>
  </table>';

$type_num = "SELECT * FROM devices WHERE serial_num = " . $serial;
$sql = "DELETE FROM devices WHERE serial_num = " . $serialF . "AND user_name = " . $user_nameF;

$resultType = $conn->query($type_num);
if ($resultType->num_rows > 0)
{
  while ($row = $resultType->fetch_assoc()) {
   $type = $row["type_num"];
  }
  echo "<script>deviceConfirm()</script>";
  $old_path = getcwd();
  chdir('/home/papaya');
  $command = "sudo ./testerRM.sh \"$serial\" \"$type\"";
  $output = shell_exec($command);
  chdir($old_path);
  $result = $conn->query($sql);
}
else {
  echo "<script>deviceFail()</script>";
}
}
?>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
