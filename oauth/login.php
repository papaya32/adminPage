<?php
session_start();
require_once("/home/papaya/.access/membersite_config.php");

if (isset($_GET["state"])) { $_SESSION["state"] = $_GET["state"]; }
if (isset($_GET["scope"])) { $_SESSION["scope"] = $_GET["scope"]; }
if (isset($_GET["client_id"])) { $_SESSION["client_id"] = $_GET["client_id"]; }
if (isset($_GET["response_type"])) { $_SESSION["response_type"] = $_GET["response_type"]; }

?>

<?php
function curl_get($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

if(isset($_POST['submitted']))
{
  if($fgmembersite->Login())
  {
    $args = array(
      'state' => urlencode($_SESSION["state"]),
      'scope' => urlencode($_SESSION["scope"]),
      'client_id' => urlencode($_SESSION["client_id"]),
      'response_type' => urlencode($_SESSION["response_type"]),
      'user_id' => urlencode($fgmembersite->UserUserName())
    );
    foreach($args as $key=>$value) { $fields_string .= $key . '=' . $value . '&'; }
    rtrim($fields_string, '&');

    $fgmembersite->RedirectToURL("authorize.php?$fields_string");

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "authorize.php");
    curl_setopt($ch, CURLOPT_GET, count($fields));
    curl_setopt($ch, CURLOPT_GETFIELDS, $fields_string);

//    $result = curl_exec($ch);

    curl_close($ch);
    

//    $str = "https://$authURL?state=" . $_SESSION["state"] . "&code=$token";
//    $str = "tester.php?state=" . $_SESSION["state"] . "&code=$token";
//    $request = curl_get($str);
    error_log("STRING: " . $str);
    $fgmembersite->RedirectToURL("https://" . $authURL);
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>PapI 2016</title>
  <link href="../style/tester.css" rel="stylesheet">
</head>

<body>
  <div id="main">
<h1>Login Page</h1>
<!-- <div id='fg_membersite'> -->
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >UserName*:</label><br/>
    <input class='inputText' type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label><br/>
    <input class='inputText' type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input class='buttonGreen' value='Login' type='submit' name='Submit' />
    <a class="buttonGreen" href="../access/register.php?action=authorize">Register</a>
</div>
<br>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
</fieldset>
</form>

<script type='text/javascript'>
    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");

    frmvalidator.addValidation("password","req","Please provide the password");
</script>
<footer id="papFoot"></footer>
</div>
<script src="../scripts/tester.js"></script>

</body>
</html>
