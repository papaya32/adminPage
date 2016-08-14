<?php
require_once("/home/papaya/.access/membersite_config.php");

$item = $_POST["item"];

$result = $fgmembersite->DelListItem($item);
?>
