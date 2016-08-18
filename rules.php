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

while ($row = mysql_fetch_assoc($result))
{
  echo "<option value='" . $row['type_num'] . "' id='" . $row['serial_num'] . "'>" . $row['name'] . "</option>\r\n";
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

while ($row = mysql_fetch_assoc($result))
{
  echo "<option value='" . $row['type_num'] . "' id='" . $row['serial_num'] . "'>" . $row['name'] . "</option>\r\n";
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

  <footer id="papFoot"></footer>
  <script src="../scripts/rules.js"></script>
</div>


</body>
</html>
