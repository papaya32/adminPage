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
