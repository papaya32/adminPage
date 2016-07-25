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
$name = $_POST["addName"];
$location = $_POST["addLocation"];
$serial = $_POST["addSerial"];
$type = $_POST["addType"];

$result = $fgmembersite->AddDevice($name, $location, $serial, $type);
if ($result != false)
{
  echo "HERE2";
  echo $result;
  echo "<script>deviceConfirm()</script>";
  echo'  <table class="blank_table">
    <tr>
      <td>Name</td>
      <td>Location</td>
      <td>Serial Number</td>
      <td>Type Number</td>
    </tr>
    <tr>
      <td>' . $name . '</td>
      <td>' . $location . '</td>
      <td>' . $serial . '</td>
      <td>' . $type . '</td>
    </tr>
  </table>';
}
else
{
  echo "HERE3";
  echo $fgmembersite->GetErrorMessage();
  echo "<script>deviceFail()</script>";
}
?>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
