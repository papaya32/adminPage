<?php
require_once("/home/papaya/.access/membersite_config.php");

$addUser = $_POST["addUser"];
$addDrink = $_POST["addDrink"];
$drinkPrice = $_POST["drinkPrice"];
$mode1 = $_POST["mode"];

if ($mode1 == "U")
{
  $result = $fgmembersite->AddBarUser($addUser);
}
else if ($mode1 == "D")
{
  $result = $fgmembersite->AddBarDrink($addDrink, $drinkPrice);
  echo $result;
}
?>
