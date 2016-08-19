<?php
require_once("/home/papaya/.access/membersite_config.php");

if (!$fgmembersite->CheckLogin())
{
  $fgmembersite->RedirectToURL("access/login.php");
  exit;
}

$id = $_POST['id'];
error_log("ID: " . $id);

$fgmembersite->DeleteRule($id);
?>
