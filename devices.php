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
  <h1>Device Manager</h1>
  <h2>Your devices
  <button class="button buttonGreen" onclick="addDevice()" class="button">Add Device</button>
  <button class="button buttonRed" onclick="removeDevice()" class="button">Remove Device</button>
  </h2>

  <h2 style="display:none" id="noDevices">No Devices Yet!</h2>

  <b><table style="display:none" id="addTitles" class="blank_table">
    <tr>
      <td id="title">Name</td>
      <td id="title">Location</td>
      <td id="title">Serial Number</td>
      <td id="title">Type Number</td>
    </tr>
  </table></b>
  <b><table style="display:none" id="removeTitles" class="blank_table">
    <tr>
      <td id="title">Serial Number</td>
    </tr>
  </table></b>

  <form style="display:none" id="addDevice" action="confirmAdd.php" method="post">
    <input type="text" class="textbox" name="addName">
    <select name="addLocation" class="textbox">
<?php
$result = $fgmembersite->GetLocations();

while ($row = mysql_fetch_assoc($result))
  {
    echo "<option value='" . $row['location_name'] . "'>" . $row['location_name'] . "</option>";
  }
?>
  </select>
    <input type="text" class="textbox" name="addSerial">
    <input type="text" class="textbox" name="addType">
    <br>
    <input type="submit" class="button" value="Submit">
  </form>
  <form style="display:none" id="removeDevice" action="confirmRemove.php" method="post">
    <input type="text" class="textbox" name="removeSerial">
    <input type="submit" class="button" value="Submit">
  </form>


  <button id="clearButton" class="button"  style="display:none; background-color: #f44336;" onclick="clearDevices()" class="button">Clear</button>

  <script>
  function clearDevices() {
    document.getElementById("addTitles").style.display = "none";
    document.getElementById("removeTitles").style.display = "none";
    document.getElementById("clearButton").style.display = "none";
    document.getElementById("addDevice").style.display = "none";
//    document.getElementById("removeDevice").style.display = "none";
    document.getElementById("noDevices").style.display = "none";
  }
  function addDevice() {
    clearDevices()
    document.getElementById("addTitles").style.display = "table";
    document.getElementById("clearButton").style.display = "initial";
    document.getElementById("addDevice").style.display = "initial";
//    document.getElementById("addLocation").style.display = "initial";
  }
  function removeDevice() {
    clearDevices()
    document.getElementById("removeTitles").style.display = "table";
    document.getElementById("removeDevice").style.display = "initial";
    document.getElementById("clearButton").style.display = "initial";
  }
  function noDevices() {
    clearDevices()
    document.getElementById("noDevices").style.display = "initial";
  }
  </script>

<br></br>
<?php
  $result = $fgmembersite->GetDevices();
//    $deleteButt1 = "<td><button value='";
//    $deleteButt2 = "' id='myBtn'><img src='./assets/trash-icon.png' width='20' height='20' border='0'/></button>";
  $deleteButt1 = '<td><button onclick="deleteDev(';
  $deleteButt2 = ');"><img src="./assets/trash-icon.png" width="20" height="20" border="0"/></button>';

//  echo "<button id='myBtn'>TESTER</button>";

  if (($result != false) && (mysql_num_rows($result) > 0))
  {
    echo '<table class="dataTable" style="width: 75%;">' . "\r\n" . '  <tr id="dataTableRow">' . "\r\n";
    echo '<td class="delete"/><td><b>Name</b></td><td><b>Location</b></td><td><b>Serial Number</b></td><td><b>Type Num</b></td></tr><tr>';
    while ($row = mysql_fetch_assoc($result))
    {
      echo $deleteButt1 . "'" . $row["serial_num"] . "'" . $deleteButt2;
//      echo $deleteButt1 . $deleteButt2;
      echo "<td>" . $row["name"] . "</td>" . "\r\n";
      echo "<td>" . $row["location"] . "</td>" . "\r\n";
      echo "<td>" . $row["serial_num"] . "</td>" . "\r\n";
      echo "<td>" . $row["type_num"] . "</td>" . "\r\n";
      echo "</tr>" . "\r\n";
    }
    echo "</table>" . "\r\n";
  }
  else
  {
    echo '<script>' . 'noDevices();' . '</script>';
  }
?>
  <footer id="papFoot"></footer>
  </div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">X</span>
      <h2>Confirm Delete</h2>
    </div>
    <div class="modal-body">
      <p>Click the button below to confirm deletion.</p>
    </div>
    <div class="modal-footer">
      <h3><button onclick=confirmDelDev() class='buttonRed'>Confirm</button></h3>
    </div>
  </div>

</div>



<script src="scripts/tester.js"></script>

</body>
</html>
