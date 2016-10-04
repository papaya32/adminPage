<?php
require_once("/home/papaya/.access/membersite_config.php");

if (!$fgmembersite->CheckLogin())
{
  $fgmembersite->RedirectToURL("access/login.php");
  exit;
}
$types = array(
"16", "13"
);
$event = array(
"16" => array("Motion Detected", "MD1"),
"13" => array("Top Button", "BU1", "Bottom Button", "BU2")
);
$action = array(
"16" => array("None", "NAN"),
"13" => array("Turn On", "DON", "Turn Off", "DOF", "Toggle", "DTO")
);
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
  <h1 id="BigTitle">Rules Manager</h1>
  <h2>Your rules
  <button class="button buttonGreen" onclick="addRule()">Add Rule</button>
  </h2>
  <h2 style="display:none" id="noRules">No Rules Yet!</h2>
<?php
$result = $fgmembersite->GetRules();
$deleteButt1 = '<td><button onclick="deleteRules(';
$deleteButt2 = ');"><img src="assets/trash-icon.png" width="20" height="20" border="0"/></button></td>';

if (($result == false) || (mysqli_num_rows($result) == 0))
{
  echo "<script>document.getElementById('noRules').style.display = 'initial'</script>";
}
else
{
echo '<table class="dataTable">' . "\r\n";
while ($row = mysqli_fetch_assoc($result))
{
  $resultT = $fgmembersite->GetDevices($row['target']);
  $resultS = $fgmembersite->GetDevices($row['source']);
  $rowT = mysqli_fetch_assoc($resultT);
  $rowS = mysqli_fetch_assoc($resultS);
  $phraseS = array_search(substr($row["detail"], 0, 3), $event[$row['typeS']]);
  $phraseT = array_search(substr($row["detail"], 3, 6), $action[$row['typeT']]);
//  echo "<h3>" . $phraseS . "</h3>";
  echo '<tr>' . $deleteButt1 . "'" . $row["id"] . "'" . $deleteButt2;
  echo '<td>' . $action[$row['typeT']][$phraseT - 1] . '</td><td>' . $rowT['name'] . "</td><td>when</td>";
  echo "<td>" . $event[$row['typeS']][$phraseS - 1] . "</td><td>on</td><td>" . $rowS['name'] . "</td></tr>";
}
echo "</table>";
}
?>

  <script>
  function addRule()
  {
    document.getElementById("clearButton").style.display = "initial";
    document.getElementById("selectTitles").style.display = "initial";
    document.getElementById("deviceName").style.display = "initial";
  }
  </script>

   <div>
    <p style="font-size: 18px; display: none;" id="selectTitles">When <select onchange="deviceName()" style="display:none" id="deviceName"><option disabled selected value>-- Device --</option></p>
<?php
$result = $fgmembersite->GetDevices();

while ($row = mysqli_fetch_assoc($result))
{
  echo "<option value='" . $row['type_num'] . "' id='" . $row['serial_num'] . "'>" . $row['name'] . " (" . $row['location'] . ")" . "</option>\r\n";
}
?>
    </select>
<?php
unset($value);
unset($value2);
foreach ($types as &$value)
{
  echo "<select style='display:none' id='" . $value . "event' onchange='eventSelect()'>";
  echo "<option disabled selected value>-- Event --</option>";
  $arraySize = count($event[$value]);
  for ($i = 0; $i < $arraySize; $i++)
  {
    if ($i & 1) { continue; }
    echo "<option value='" . $event[$value][$i + 1] . "'>" . $event[$value][$i] . "</option>";
  }
  echo "</select>";
}
?>
<p style="font-size: 18px; display:none" id="nextTitle"> then </p><select id="target" onchange="targetSelect()" style="display:none"><option disabled selected value>-- Device --</option>
<?php
$result = $fgmembersite->GetDevices();

while ($row = mysqli_fetch_assoc($result))
{
  echo "<option value='" . $row['type_num'] . "' id='" . $row['serial_num'] . "'>" . $row['name'] . " (" . $row['location'] . ")" . "</option>\r\n";
}
?>
</select>
<?php
unset($value);
foreach ($types as &$value)
{
  echo "<select style='display:none' id='" . $value . "action' onchange='actionSelect()'>";
  echo "<option disabled selected value>-- Action --</option>";
  $arraySize = count($action[$value]);
  for ($i = 0; $i < $arraySize; $i++)
  {
    if ($i & 1) { continue; }
    echo "<option value='" . $action[$value][$i + 1] . "'>" . $action[$value][$i] . "</option>";
  }
  echo "</select>";
}
?>
  <button id="submitButton" class="button" style="display:none; background-color: green;" onclick="submit()">Submit</button>
  <button id="clearButton" class="button" style="display:none; background-color: #f44336;" onclick="clearRules()">Clear</button>
  </div>

<div id="deleteModal" class="modal">

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
      <h3><button onclick=confirmDelRule() class='buttonRed'>Confirm</button></h3>
    </div>
  </div>

</div>

  <footer id="papFoot"></footer>
  <script src="../scripts/rules.js"></script>
</div>


</body>
</html>
