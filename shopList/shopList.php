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
<!--  <h1>Shopping List</h1> -->
  <h2>List Items <a href="../barTab/barTab.php"><button class="button buttonBlue">Bar Tabs</button></a></h2>
<!--   <button class="button buttonGreen" onclick="addItem()" class="button">Add Item</button> -->

  <b><table id="addTitles">
    <tr>
      <td id="title">Quantity</td>
      <td id="title">Item</td>
      <td>Category</td>
    </tr>
    <tr>
      <td width="15%"><input style="width: 90%" type="text" class="textbox" id="itemQuantity"/></td>
      <td width="45%"><input style="width: 90%" type="text" class="textbox" id="itemName"/></td>
      <td><select id="selectCategory" style="width: 90%" name="category" class="textbox">
<?php
$result = $fgmembersite->GetCategories();

if ($result != false)
{
  while ($row = mysql_fetch_assoc($result))
  {
    echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
  }
}
else
{
  echo "<option><i>No Categories in Server!</i></option>";
}
?>
      </select></td>
    </tr>
  </table></b>
  <button class="button buttonGreen" id="itemSubmit" onclick="itemSubmit()">Add Item</button>


<?php
$result = $fgmembersite->GetListItems();

$deleteButt1 = '<td><button onclick="delListItem(';
$deleteButt2 = ');"><img src="../assets/trash-icon.png" width="20" height="20" border="0"/></button></td>';

if (($result != false) && (mysql_num_rows($result) > 0))
{
  echo "<table id='itemTable' class='dataTable' style='width: 80%'><tr>";
  echo "<td class='delete'/>";
  echo "<td><b>Item</b></td>";
  echo "<td><b>Category</b></td>";
  echo "<td><b>Quantity</b></td></tr>";
  while ($row = mysql_fetch_assoc($result))
  {
    if (($temp != $row["category"]) || (!isset($temp)))
    {
      $temp = $row["category"];
      echo "<tr>" . $deleteButt1 . "'" . $row["item_name"] . "'" . $deleteButt2;
      if ($row["retrieved"] == 'y')
      {
        echo "<td onclick=" . '"' . "crossItem('" . $row["item_name"] . "');" . '"' . "id='" . $row["item_name"] . "' class='strike'>" . $row["item_name"] . "</td>";
      }
      else
      {
        echo "<td onclick=" . '"' . "crossItem('" . $row["item_name"] . "');" . '"' . "id='" . $row["item_name"] . "'>" . $row["item_name"] . "</td>";
      }
      echo "<td>" . $row["category"] . "</td>";
      echo "<td>" . $row["item_quant"] . "</td></tr>";
    }
    else
    {
      echo "<tr>";
      echo $deleteButt1 . "'" . $row["item_name"] . "'" . $deleteButt2;
      if ($row["retrieved"] == 'y')
      {
        echo "<td onclick=" . '"' . "crossItem('" . $row["item_name"] . "');" . '"' . "id='" . $row["item_name"] . "' class='strike'>" . $row["item_name"] . "</td>";
      }
      else
      {
        echo "<td onclick=" . '"' . "crossItem('" . $row["item_name"] . "');" . '"' . "id='" . $row["item_name"] . "'>" . $row["item_name"] . "</td>";
      }
      echo "<td/>";
      echo "<td>" . $row["item_quant"] . "</td></tr>";
    }
  }
  echo "</table>";
}
else
{
  echo "<h3><i>No items on the shopping list!</i></h3>";
}
?>


<script>
  function addItem()
  {
    document.getElementById("addTitles").style.display = "initial";
    document.getElementById("itemSubmit").style.display = "initial";
  }
</script>

<footer id="papFoot"></footer>
<script src="../scripts/tester.js"></script>
</div>
</body>
</html>
