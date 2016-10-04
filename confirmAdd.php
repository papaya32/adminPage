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
  <h1 id="deviceTitle"></h1>
<script>
  function deviceAdd(state) {
    var message;
    if (state) {
      message = "Device Added!";
    }
    else {
      message = "Failed To Add Device!";
    }
    document.getElementById("deviceTitle").innerHTML = message;
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
  echo "<script>deviceAdd(true)</script>";
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
  echo "<div><span class='error'>" . $fgmembersite->GetErrorMessage() . "</span></div>";
  echo "<script>deviceAdd(false)</script>";
}
?>
  <br>
  <a href='tester.php' class="button buttonGreen">Home</a>
  <a href='devices.php' class="button buttonGreen">Return to Devices</a>


  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
