<?php
$people = array(
"Alex"=>"caterpillar-icon.png",
"Harrison"=>"battery-icon.png",
"Jack"=>"wifi-icon.svg",
"Bryce"=>"whale-icon.png");

$drinks = array(
"Heineken"=>"heineken-icon.png",
"Miller Lite"=>"miller-icon.png",
"Coke"=>"coke-icon.png");

$price = array(
"Heineken"=>"1.09",
"Miller Lite"=>"0.96",
"Coke"=>"0.48");

$imgVar1 = "<img src='../assets/";
$imgVar2 = "' width='115' height='115' border='0'/>";
?>

<header>
  <title>PapI 2016</title>
  <link href="../style/dashboard.css" rel="stylesheet">
  <script src="../scripts/tester.js"></script>
</header>

<div class="container">
  <h1T>411 Bar Tab Dashboard</h1T>
  <div class="right">
    <h2>906 Rose St</h2>
  </div>
  <div class='spacer'>
    <a href="javascript:name('Bryce')" class='box blue'>
      <?php echo $imgVar1 . $people['Bryce'] . $imgVar2;?>
      <h2>Bryce</h2>
    </a>
    <a href="javascript:name('Jack')" class='box redgay'>
      <?php echo $imgVar1 . $people['Jack'] . $imgVar2;?>
      <h2>Jack</h2>
    </a>
    <a href="javascript:name('Harrison')" class='box lime'>
      <?php echo $imgVar1 . $people['Harrison'] . $imgVar2;?>
      <h2>Harrison</h2>
    </a>
  </div>
  <div class='spacer'>
    <?php $drink = "Miller Lite";
    echo '
    <a href="javascript:drink(\'' . $drink . '\', \'' . $price[$drink] . '\')" class="box blue">';
      echo $imgVar1 . $drinks["$drink"] . $imgVar2;
      echo '<h2>' . $drink . '</h2>'; echo '<h2R>$' . $price["$drink"] . '</h2R>';
    echo '</a>';?>
    <?php $drink = "Heineken";
    echo '
    <a href="javascript:drink(\'' . $drink . '\', \'' . $price[$drink] . '\')" class="box lime">';
      echo $imgVar1 . $drinks["$drink"] . $imgVar2;
      echo '<h2>' . $drink . '</h2>'; echo '<h2R>$' . $price["$drink"] . '</h2R>';
    echo '</a>';?>
    <?php $drink = "Coke";
    echo '
    <a href="javascript:drink(\'' . $drink . '\', \'' . $price[$drink] . '\')" class="box bluefish">';
      echo $imgVar1 . $drinks["$drink"] . $imgVar2;
      echo '<h2>' . $drink . '</h2>'; echo '<h2R>$' . $price["$drink"] . '</h2R>';
    echo '</a>';?>
  </div>
</div>
<div id='container'>
  <h1>&emsp;</h1><h1 id='name' style='display:none'></h1><h1 style='display:none' id='filler1'>&nbsp;drank a&nbsp;</h1><h1 style='display:none' id='drink'></h1><h1 style='display:none' id='filler2'>&nbsp; for $</h1><h1 style='display:none' id='price'></h1><h1 id='test'>&nbsp;</h1>
  <button class='buttonGreen' onclick='drinkSubmit()' id='drinkSubmit' style='display:none'>Submit</button>
</div>
<div class='container'>
  <footer id="papFoot"></footer>
</div>
