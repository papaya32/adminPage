<?php
require_once("/home/papaya/.access/membersite_config.php");

if (!$fgmembersite->CheckLogin())
{
  $fgmembersite->RedirectToURL("access/login.php");
  exit;
}

$source = $_POST['source'];
$target = $_POST['target'];
$detail = $_POST['detail'];
$type = $_POST['type'];

$fgmembersite->SubmitRule($source, $target, $detail, $type);
?>
