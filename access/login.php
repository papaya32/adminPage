<?PHP
require_once("/home/papaya/.access/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("../tester.php");
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
    <a href="register.php"><button class='buttonGreen'>Register</button></a>
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
