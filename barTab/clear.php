<?php
require_once("/home/papaya/.access/membersite_config.php");

$name = $_POST["clearName"];

$result = $fgmembersite->ClearTab($name);
?>
