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

<script>
  function locationFail() {
    document.getElementById("locationFail").style.visibility = "visible";
  }
  function locationConfirm() {
    document.getElementById("locationConfirm").style.visibility = "visible";
  }
</script>
<?php
$name = $_POST["addLocation"];

  $result = $fgmembersite->AddLocation($name);

  if ($result == false)
  {
    echo "<div><span class='error'>" . $fgmembersite->GetErrorMessage() . "</span></div>";
    echo "<script>locationFail()</script>";
  }
  else
  {
    echo "<script>locationConfirm()</script>";
    echo '  <table class="blank_table">
    <tr>
        <td>Location</td>
      </tr>
      <tr>
        <td>' . $_POST["addLocation"] . '</td>
      </tr>
    </table>';
  }
?>
  <br>

  <a href='tester.php' class="button buttonGreen">Home</a>
  <a href='locations.php' class="button buttonGreen">Return to Locations</a>

  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
