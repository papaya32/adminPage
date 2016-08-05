<?php
require_once("/home/papaya/.access/membersite_config.php");

$name = $_GET["name"];
$price = $_GET["price"];

$tab = $fgmembersite->AddToBarTab($name, $price);

if ($tab != false)
{
  echo "<h1>" . $name . ", your bar tab is now $" . $tab . "</h1>";
}
else
{
  echo "false";
}
?>
