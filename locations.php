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
$result = $fgmembersite->GetLocations();
$deleteButt1 = '<td><button onclick="deleteLoc(';
$deleteButt2 = ');"><img src="./assets/trash-icon.png" width="20" height="20" border="0"/></button>';

if (($result != false) && (mysqli_num_rows($result) > 0))
{
        echo '<table class="dataTable" style="width: 75%">' . "\r\n" . '  <tr id="dataTableRow">' . "\r\n";
        echo '<td class="delete"/><td><b>Location</b></td><td><b>Devices</b></td></tr>';
        while ($row = mysqli_fetch_assoc($result))
        {
                echo $deleteButt1 . "'" . $row["location_name"] . "'" . $deleteButt2 . "</td>";
		echo "<td>" . $row["location_name"] . "</td>";
                $resultD = $fgmembersite->GetDevicesInLocations($row["location_name"]);
		$temp = 1;
		if (mysqli_num_rows($resultD) > 0)
		{
                  while ($rowD = mysqli_fetch_assoc($resultD))
                  {
                    if ($temp == 1)
                    {
                      $temp = 0;
                    }
		    else
                    {
                      echo "<tr><td/><td/>";
                    }
                    echo "<td>" . $rowD["name"] . "</td></tr>\r\n";
                  }
		}
		else
		{
		  echo "<td><i>None</i></td></tr>";
		}
        }
        echo "</table>" . "\r\n";
}
else
{
        echo '<script>' . 'noLocations();' . '</script>';
}
?>
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
      <h3><button onclick=confirmDelLoc() class='buttonRed'>Confirm</button></h3>
    </div>
  </div>

</div>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>
