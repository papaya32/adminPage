document.getElementById("papFoot").innerHTML =
"<p>&copy; " + new Date().getFullYear() + " PapI. All rights reserved.</p>";

document.getElementById("nav01").innerHTML =
"<ul id='menu'>" +
"<li><a href='tester.php'>Home</a></li>" +
"<li><a href='devices.php'>Devices</a></li>" +
"<li><a href='locations.php'>Locations</a></li>" +
"<li><a href='rules.php'>Rules</a></li>" +
"<li><a href='access/logout.php'><font color='red'>Logout</font></a></li>" +
"</ul>";

var source;
var target;
var detail1;
var detail2;
var active;
var type;
var typeS;
var temp1;
var temp2;
var temp3;
var delId;

var modal = document.getElementById("deleteModal");
var span = document.getElementsByClassName("close")[0];

function deviceName()
{
  typeS = document.getElementById("deviceName").value;
  var options = document.getElementById("deviceName").options;
  source = options[options.selectedIndex].id;

  var eventSelect = typeS + "event";
  console.log("eventselect: " + eventSelect);
  document.getElementById(eventSelect).style.display = "initial";
}

function eventSelect()
{
  document.getElementById("nextTitle").style.display = "initial";
  document.getElementById("target").style.display = "initial";

  temp1 = typeS + "event";
  var options = document.getElementById(temp1).options;
  detail1 = options[options.selectedIndex].value;
}

function targetSelect()
{
  var options = document.getElementById("target").options;
  type = options[options.selectedIndex].value;
  target = options[options.selectedIndex].id;
  temp2 = type + "action";
  document.getElementById(temp2).style.display = "initial";
}

function actionSelect()
{
  var options = document.getElementById(type + "action").options;
  detail2 = options[options.selectedIndex].value;

  document.getElementById("submitButton").style.display = "initial";
}

function clearRules()
{
  document.getElementById("clearButton").style.display = "none";
  document.getElementById("selectTitles").style.display = "none";
  document.getElementById("deviceName").style.display = "none";
  document.getElementById("event").style.display = "none";
  document.getElementById("nextTitles").style.display = "none";
  document.getElementById("target").style.display = "none";
  document.getElementById(temp1).style.display = "none";
  document.getElementById(temp2).style.display = "none";
  document.getElementById("submitButton").style.display = "none";
}

function addRule()
{
  document.getElementById("clearButton").style.display = "initial";
  document.getElementById("selectTitles").style.display = "initial";
  document.getElementById("deviceName").style.display = "initial";
}

function submit()
{
  str = "source=" + source + "&target=" + target + "&detail=" + detail1 + detail2 + "&typeT=" + type + "&typeS=" + typeS;
  console.log("STR: " + str);
  var request = new XMLHttpRequest();
  request.open("POST", "ruleSubmit.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(str);
  setTimeout(function() { location.reload();}, 400);

  console.log("Source: " + source);
  console.log("Target: " + target);
  console.log("Detail1: " + detail1);
  console.log("Detail2: " + detail2);
  console.log("Type: " + type);
}

function deleteRules(id)
{
  modal.style.display = "block";
  delId = id;
}

window.onclick = function(event)
{
  if (event.target == modal)
  {
    modal.style.display = "none";
  }
}

function confirmDelRule()
{
  console.log("Confirmed: " + delId);
  str = "id=" + delId;
  var request = new XMLHttpRequest();
  request.open("POST", "ruleDelete.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(str);
  setTimeout(function () { location.reload();}, 400);
}

span.onclick = function()
{
  modal.style.display = "none";
}
