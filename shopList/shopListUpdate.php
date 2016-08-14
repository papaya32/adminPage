<?php
require_once("/home/papaya/.access/membersite_config.php");

$item = $_POST["item"];
$mode = $_POST["mode"];

if ($mode == "new")
{
  $quantity = $_POST["quant"];
  $item = $_POST["name"];
  $category = $_POST["category"];

  $result = $fgmembersite->AddShoppingItem($quantity, $item, $category);
}
else
{
  $item = $_POST["item"];

  $result = $fgmembersite->UpdateShoppingList($item, $mode);
}
?>
