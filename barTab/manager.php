<?php
require_once("/home/papaya/.access/membersite_config.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>PapI 2016</title>
  <link href="../style/tester.css" rel="stylesheet">
</head>

<body>
  <div id="main">
  <h1>Bar Tab Manager</h1>

  <button class="button buttonGreen" onclick="addBarUser()">Add User</button>
  <button class="button buttonGreen" onclick="addBarDrink()">Add Drink</button>
  <br>
  <b><table style="display:none" id="addUserTitles" class="blank_table">
    <tr>
      <td>Name</td>
    </tr>
  </table></b>
  <b><table style="display:none" id="addDrinkTitles" class="blank_table">
    <tr>
      <td>Drink Name</td>
      <td>Price ($)</td>
    </tr>
  </table></b>
  <br>

  <input type="text" style="display:none" class="textbox" id="barUserName"/>
  <input type="text" style="display:none" class="textbox" id="barDrinkName"/>
  <input type="text" style="display:none" class="textbox" id="barPrice"/>
  <button id="submitButtonD" class="button" style="display:none" onclick="barManSubmit('D');">Submit</button>
  <button id="submitButtonU" class="button" style="display:none" onclick="barManSubmit('U');">Submit</button>
  <button id="clearButton" class="button" style="display:none; background-color: #f44336;" onclick="clearDevices();">Clear</button>

  <script>
  function clearDevices()
  {
    document.getElementById("barUserName").style.display = "none";
    document.getElementById("barDrinkName").style.display = "none";
    document.getElementById("barPrice").style.display = "none";
    document.getElementById("submitButtonD").style.display = "none";
    document.getElementById("submitButtonU").style.display = "none";
    document.getElementById("clearButton").style.display = "none";
    document.getElementById("addUserTitles").style.display = "none";
    document.getElementById("addDrinkTitles").style.display = "none";
  }
  function addBarUser()
  {
    clearDevices();
    document.getElementById("addUserTitles").style.display = "initial";
    document.getElementById("barUserName").style.display = "initial";
    document.getElementById("clearButton").style.display = "initial";
    document.getElementById("submitButtonU").style.display = "initial";
  }
  function addBarDrink()
  {
    clearDevices();
    document.getElementById("addDrinkTitles").style.display = "initial";
    document.getElementById("barDrinkName").style.display = "initial";
    document.getElementById("barPrice").style.display = "initial";
    document.getElementById("submitButtonD").style.display = "initial";
    document.getElementById("clearButton").style.display = "initial";
  }
</script>
<?php
  $result = $fgmembersite->GetBarTabs();

  if (($result != false) && (mysql_num_rows($result) > 0))
  {
    echo '<table class="dataTable" style="width: 75%">';
    echo '<tr><td/><td><b>Name</b></td><td><b>Owed Tab</b></td></tr></b>';
    while ($row = mysql_fetch_assoc($result))
    {
      echo '<tr><td class="delete"><button style="color:red;font-weight:bold;" onclick="clearTab(' . "'" . $row["name"] . "'" . ');">Clear</button></td>';
      echo '<td>' . $row["name"] . '</td>';
      echo '<td>$ ' . $row["tab"] . '</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
  else
  {
    echo '<h2>No one in the SQL server!</h2>';
  }
?>

<div id="myModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span onclick="closeModal();" class="close">X</span>
      <h2>Confirm Clear</h2>
    </div>
    <div class="modal-body">
      <p>Click the button below to confirm clearing.</p>
    </div>
    <div class="modal-footer">
      <h3><button onclick=confirmClearTab() class="buttonRed">Confirm</button></h3>
    </div>
  </div>
</div>

  <footer id="papFoot"></footer>
</div>
<script src="../scripts/tester.js"></script>

</body>
</html>
