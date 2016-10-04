<?php
// include our OAuth2 Server object
require_once __DIR__.'/server.php';
require_once("/home/papaya/.access/membersite_config.php");
header('Content-Type: application/json');

if (!$fgmembersite->CheckLogin())
{
  $fgmembersite->RedirectToURL("/var/www/html/access/login.php");
  exit;
}

if (!isset($_GET["action"]))
{
  $output = json_encode(array("error" => "no_action"));
  echo $output;
  die;
}
$action = $_GET["action"];

$username = $fgmembersite->UserUserName();

if ($action == "discover")
{
  $result = $fgmembersite->DeviceDiscover($username);
  $length = count($result);

  $devices = "";
  $count = 0;

  foreach($result as $key => $value)
  {
    $devices .= json_encode($value);
    if ($count == ($length - 1))
    {
      continue;
    }
    $devices .= ",";
    $count++;
  }
  echo $devices;
}

else if (($action == "TurnOnRequest") || ($action == "TurnOffRequest"))
{
  if (!isset($_GET["device_id"]))
  {
    $output = json_encode(array("error" => "no_device"));
    echo $output;
    die;
  }
  $device_id = $_GET["device_id"];
  $result = $fgmembersite->CheckOwnership($username, $device_id);
  if (!$result)
  {
    $output = json_encode(array("error" => "false_ownership"));
    echo $output;
    die;
  }

  while ($row = mysqli_fetch_assoc($result))
  {
    $type = $row["type_num"];
  }

  $command = escapeshellcmd("/home/papaya/scripts/python/control.py $device_id $action $type");
  $output = shell_exec($command);

  $output = json_encode(array("message"=>"Success"));
  echo $output;
  die;
}


?>
