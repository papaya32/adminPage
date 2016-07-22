<?PHP
require_once("/home/papaya/.access/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("access/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>PapI 2016</title>
  <link href="style/tester.css" rel="stylesheet">
</head>

<nav id="nav01"></nav>

<body>

  <div id="main">
  <h1>Welcome to PapI 2016</h1> 
  <h2>Administration Page</h2>

  <h3>Here you can...</h3>
  <ul>
  <li><p>Manage your devices</p></li>
  <li><p>Manage your sitemap</p></li>
  <li><p>Manage your rules</p></li>
  </ul>

  <br>

  <footer id="papFoot"></footer>
  </div>

<script src="scripts/tester.js"></script>

</body>
</html>

