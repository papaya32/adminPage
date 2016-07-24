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
  <h1 style="visibility:hidden" id="locationConfirm">Location Removed!</h1>
  <h1 style="visibility:hidden" id="locationFail">Failed to Remove Location!</h1>
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

$location = $_POST["removeLocation"];
$user_name = $fgmembersite->UserUserName();

$conn = new mysqli($servername, $username, $password, $database);

if (strlen(strval($location)) <= 50)
{
if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
}

$locationF = "'" . $_POST["removeLocation"] . "'";
$user_nameF = "'" . $user_name . "'";

echo'  <table class="blank_table">
    <tr>
      <td>Location Name</td>
    </tr>
    <tr>
      <td>' . $_POST["removeLocation"] . '</td>
    </tr>
  </table>';

$type_num = "SELECT * FROM locations WHERE location_name = " . $locationF;
$sql = "DELETE FROM locations WHERE location_name = " . $locationF . " AND user_name = " . $user_nameF;

$resultType = $conn->query($type_num);
if ($resultType->num_rows > 0)
{
  while ($row = $resultType->fetch_assoc()) {
   $type = $row["type_num"];
  }
  echo "<script>locationConfirm()</script>";
  /* $old_path = getcwd();
  chdir('/home/papaya');
  $command = "sudo ./testerRM.sh \"$serial\" \"$type\"";
  $output = shell_exec($command);
  chdir($old_path); */
  $result = $conn->query($sql);
}
else {
  echo "<script>locationFail()</script>";
}
}
?>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
