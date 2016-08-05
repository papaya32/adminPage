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

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var nameValue;
var drinkValue;
var priceValue;

function clearSection()
{
  document.getElementById("name").style.display = "none";
  document.getElementById("price").style.display = "none";
  document.getElementById("filler1").style.display = "none";
  document.getElementById("drink").style.display = "none";
  document.getElementById("filler2").style.display = "none";
  document.getElementById("drinkSubmit").style.display = "none";
}

function name(temp)
{
  nameValue = temp;
  document.getElementById("name").innerHTML = nameValue;
  document.getElementById("name").style.display = "initial";
  document.getElementById("filler1").style.display = "initial";
}

function drink(temp, priceTemp)
{
  drinkValue = temp;
  priceValue = priceTemp;
  document.getElementById("drink").innerHTML = drinkValue;
  document.getElementById("drink").style.display = "initial";
  document.getElementById("filler2").style.display = "initial";
  document.getElementById("price").innerHTML = priceValue;
  document.getElementById("price").style.display = "initial";
  document.getElementById("drinkSubmit").style.display = "initial";
}

/* function drinkSubmit()
{
  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200)
      callback(request.responseText);
  }
  var callback = "mqtt.oreillyj.com";
  var requestString = "/barTab/submit.php?name=" + nameValue + "&price=" + priceValue;
  console.log(requestString);
  request.open("GET", requestString, true);
  request.send(null);
} */

function drinkSubmit()
{
  var request = new XMLHttpRequest();
  var str = "/barTab/submit.php?name=" + nameValue + "&price=" + priceValue;
  console.log(str);
  request.open("GET", str, false);
  request.send(null);
  clearSection();
//  return request.responseText;
}
