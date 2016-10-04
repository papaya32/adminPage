<?php
// include our OAuth2 Server object
session_start();
require_once __DIR__.'/server.php';
require_once("/home/papaya/.access/membersite_config.php");

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}
// display an authorization form
if (empty($_POST)) {
  $userFullName = $fgmembersite->UserFullName();
  $queryString = "<!DOCTYPE html><html><head><title>PapI 2016</title><link href='../style/tester.css' rel='stylesheet'></head>
  <body><div id='main'><h1>Authorization Request</h1>$userFullName, do you allow the Amazon Alexa service to control your devices?
  <form method='post'>
  <input type='submit' class='buttonGreen' name='authorized' value='Yes'>
  <input type='submit' class='buttonRed' name='authorized' value='No'>
  </form>
  <footer id='papFoot'></footer></div><script src='../scripts/tester.js'></script></body></html>";

  exit($queryString);
}

// print the authorization code if the user has authorized your client
$is_authorized = ($_POST['authorized'] === 'Yes');
$server->handleAuthorizeRequest($request, $response, $is_authorized, $fgmembersite->UserUserName());
if ($is_authorized) {
  // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
  $str = "https://" . $fgmembersite->AmazonURL . "?code=$code&state=" . $_SESSION["state"];
  header("Location: $str");
  exit("SUCCESS!");
  //$fgmembersite->RedirectToURL($str);
}
$response->send();
?>
